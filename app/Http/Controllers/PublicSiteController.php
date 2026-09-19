<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\StoreNewcomerRequest;
use App\Models\ChurchInfo;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\Ministry;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function home(): View
    {
        $churchInfo = ChurchInfo::current();

        $upcomingEvents = Event::where('status', 'open')
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $ministries = Ministry::withCount('activeMemberships')->take(6)->get();

        return view('public.home', compact('churchInfo', 'upcomingEvents', 'ministries'));
    }

    public function about(): View
    {
        $churchInfo = ChurchInfo::current();

        return view('public.about', compact('churchInfo'));
    }

    public function imNewShow(): View
    {
        return view('public.im-new');
    }

    public function imNewStore(StoreNewcomerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Tránh tạo trùng nếu email đã tồn tại trong hệ thống (Newcomer hoặc Member)
        $existing = ! empty($data['email'])
            ? Person::where('email', $data['email'])->first()
            : null;

        if ($existing) {
            return back()->with('info', 'Cảm ơn bạn! Thông tin của bạn đã có trong hệ thống của Hội Thánh, chúng tôi sẽ liên hệ sớm.');
        }

        Person::create([
            'name' => $data['name'],
            'gender' => $data['gender'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'hometown' => $data['hometown'] ?? null,
            'family_background' => $data['message'] ?? null, // lời nhắn ban đầu, admin có thể cập nhật lại sau
            'person_type' => 'newcomer',
        ]);

        return redirect()->route('im-new')->with('success', 'Cảm ơn bạn đã kết nối với Hội Thánh! Chúng tôi sẽ sớm liên lạc với bạn.');
    }

    public function contactShow(): View
    {
        $churchInfo = ChurchInfo::current();

        return view('public.contact', compact('churchInfo'));
    }

    public function contactStore(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')->with('success', 'Tin nhắn của bạn đã được gửi. Cảm ơn bạn đã liên hệ!');
    }

    public function events(): View
    {
        $events = Event::whereIn('status', ['open', 'closed'])
            ->orderBy('start_date')
            ->paginate(9);

        return view('public.events.index', compact('events'));
    }

    public function eventShow(Event $event): View
    {
        $event->loadCount(['approvedParticipants']);

        return view('public.events.show', compact('event'));
    }

    public function eventRegister(StoreEventRegistrationRequest $request, Event $event): RedirectResponse
    {
        if ($event->status !== 'open') {
            return back()->with('error', 'Sự kiện này hiện không mở đăng ký.');
        }

        if ($event->is_full) {
            return back()->with('error', 'Rất tiếc, sự kiện đã đủ số lượng đăng ký.');
        }

        $data = $request->validated();

        // Tìm Person theo email, nếu chưa có thì tạo mới với vai trò Newcomer
        $person = Person::where('email', $data['email'])->first();

        if (! $person) {
            $person = Person::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'person_type' => 'newcomer',
            ]);
        }

        $alreadyRegistered = $event->registrations()->where('person_id', $person->id)->exists();

        if ($alreadyRegistered) {
            return back()->with('info', 'Bạn đã đăng ký sự kiện này rồi.');
        }

        $event->registrations()->create([
            'person_id' => $person->id,
            'status' => 'pending',
        ]);

        return redirect()->route('events.show', $event)
            ->with('success', 'Đăng ký thành công! Vui lòng chờ Admin xác nhận qua email/điện thoại.');
    }

    public function ministries(): View
    {
        $ministries = Ministry::withCount('activeMemberships')->get();

        return view('public.ministries.index', compact('ministries'));
    }

    public function ministryShow(Ministry $ministry): View
    {
        // Chỉ hiển thị tên + vai trò công khai, KHÔNG lộ phone/email của thành viên
        $activeMembers = $ministry->activeMemberships()->with(['person', 'role'])->get();

        return view('public.ministries.show', compact('ministry', 'activeMembers'));
    }

    public function comingSoon(string $page): View
    {
        $titles = [
            'sermons' => 'Sermons / Media',
            'gallery' => 'Gallery',
        ];

        $title = $titles[$page] ?? 'Coming Soon';

        return view('public.coming-soon', compact('title'));
    }
}
