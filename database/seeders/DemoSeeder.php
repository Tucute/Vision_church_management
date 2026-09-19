<?php

namespace Database\Seeders;

use App\Models\ChurchInfo;
use App\Models\Contributor;
use App\Models\Event;
use App\Models\Fund;
use App\Models\Ministry;
use App\Models\MinistryRole;
use App\Models\Notification;
use App\Models\Person;
use App\Models\Transaction;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    private \Faker\Generator $faker;

    public function run(): void
    {
        // Dùng Faker locale vi_VN để có tên/địa chỉ tiếng Việt tự nhiên
        $this->faker = FakerFactory::create('vi_VN');

        $admin = User::where('role', 'admin')->first()
            ?? User::create([
                'name' => 'Administrator',
                'email' => 'admin@church.local',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]);

        $this->seedChurchInfo();
        $people = $this->seedPeople(40);
        $this->seedMinistries($people);
        [$funds, $contributors] = $this->seedFinance($people, $admin);
        $this->seedEvents($people, $admin);
        $this->seedNotifications($admin);
        $this->seedApproverAndUserAccounts($people);

        $this->command->info('Demo data đã được tạo: '.Person::count().' người, '
            .Ministry::count().' ban ngành, '.Transaction::count().' giao dịch, '
            .Event::count().' sự kiện, '.Notification::count().' thông báo.');
    }

    private function seedChurchInfo(): void
    {
        ChurchInfo::updateOrCreate(['id' => 1], [
            'name' => 'Hội Thánh Tin Lành Ân Điển',
            'vision' => 'Trở thành một cộng đồng đức tin yêu thương, gắn kết và phát triển bền vững.',
            'mission' => 'Rao truyền Phúc Âm, gây dựng môn đồ, và phục vụ cộng đồng bằng tình yêu thương.',
            'history' => 'Hội Thánh được thành lập năm 1998, khởi đầu với 20 thành viên và phát triển đến ngày nay.',
            'contact_info' => ['phone' => '028-1234-5678', 'email' => 'lienhe@hoithanh.org'],
            'social_links' => ['facebook' => 'https://facebook.com/hoithanhanidien', 'youtube' => 'https://youtube.com/@hoithanhanidien'],
            'address' => '123 Đường Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh',
        ]);
    }

    private function seedPeople(int $count): \Illuminate\Support\Collection
    {
        $hometowns = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng', 'Nha Trang', 'Huế', 'Vũng Tàu'];
        $occupations = ['Giáo viên', 'Kỹ sư', 'Bác sĩ', 'Sinh viên', 'Kinh doanh', 'Nhân viên văn phòng', 'Nội trợ', 'Kế toán'];
        $familyBackgrounds = [
            'Gia đình theo đạo từ 3 đời, bố mẹ đều là tín hữu lâu năm trong Hội Thánh.',
            'Là người đầu tiên trong gia đình tin Chúa, gia đình gốc theo Phật giáo.',
            'Gia đình có hoàn cảnh khó khăn, bố mất sớm, mẹ làm nông nuôi 3 con.',
            'Con một trong gia đình, bố mẹ làm kinh doanh, điều kiện kinh tế ổn định.',
            'Đã lập gia đình, có 2 con nhỏ, vợ/chồng chưa tin Chúa.',
            'Sống cùng ông bà từ nhỏ do bố mẹ đi làm xa.',
            null, null, // một số người không có thông tin (thực tế thường thiếu dữ liệu này)
        ];
        $maritalStatuses = ['single', 'single', 'married', 'married', 'married', 'divorced', 'widowed', null];

        $people = collect();

        // 70% Member, 30% Newcomer - tỉ lệ hợp lý cho 1 hội thánh đang hoạt động
        for ($i = 0; $i < $count; $i++) {
            $isMember = $i < $count * 0.7;
            $gender = $this->faker->randomElement(['male', 'female']);
            $dob = $this->faker->dateTimeBetween('-70 years', '-16 years');

            $person = Person::create([
                'name' => $gender === 'male' ? $this->faker->name('male') : $this->faker->name('female'),
                'gender' => $gender,
                'date_of_birth' => $dob,
                'hometown' => $this->faker->randomElement($hometowns),
                'occupation' => $this->faker->randomElement($occupations),
                'family_background' => $this->faker->randomElement($familyBackgrounds),
                'marital_status' => $dob < now()->subYears(18) ? $this->faker->randomElement($maritalStatuses) : null,
                'phone' => '09'.$this->faker->numerify('########'),
                'email' => $this->faker->unique()->safeEmail(),
                'address' => $this->faker->address(),
                'person_type' => $isMember ? 'member' : 'newcomer',
                'member_status' => $isMember ? $this->faker->randomElement(['active', 'active', 'active', 'inactive']) : null,
                'member_since' => $isMember ? $this->faker->dateTimeBetween('-10 years', '-1 month') : null,
            ]);

            $people->push($person);
        }

        // Thêm vài Newcomer bị reject để demo đủ trạng thái
        Person::inRandomOrder()->where('person_type', 'newcomer')->take(2)->get()
            ->each(fn ($p) => $p->rejectNewcomer('Không còn liên lạc được sau 3 tháng.'));

        return $people;
    }

    private function seedMinistries(\Illuminate\Support\Collection $people): void
    {
        $roles = MinistryRole::pluck('id', 'name');
        $members = $people->where('person_type', 'member');

        $ministries = [
            ['name' => 'Ban Thờ Phượng', 'description' => 'Phụ trách âm nhạc và thờ phượng trong các buổi nhóm.'],
            ['name' => 'Ban Truyền Giáo', 'description' => 'Tổ chức các hoạt động truyền giáo và tiếp cận cộng đồng.'],
            ['name' => 'Ban Thiếu Nhi', 'description' => 'Chăm sóc và dạy dỗ các em thiếu nhi.'],
            ['name' => 'Ban Hậu Cần', 'description' => 'Hỗ trợ hậu cần cho các sự kiện và sinh hoạt hội thánh.'],
            ['name' => 'Ban Truyền Thông', 'description' => 'Quản lý website, mạng xã hội và ghi hình các buổi nhóm.'],
        ];

        foreach ($ministries as $data) {
            $ministry = Ministry::create($data);

            // Mỗi ministry có 3-8 thành viên với vai trò ngẫu nhiên
            $assigned = $members->random(min($members->count(), rand(3, 8)));
            $leaderAssigned = false;

            foreach ($assigned as $person) {
                $roleName = ! $leaderAssigned ? 'Trưởng ban' : $this->faker->randomElement(['Phó ban', 'Thành viên', 'Thành viên']);
                $leaderAssigned = true;

                $ministry->memberships()->create([
                    'person_id' => $person->id,
                    'ministry_role_id' => $roles[$roleName],
                    'start_date' => $this->faker->dateTimeBetween('-3 years', '-1 month'),
                    // 20% đã kết thúc phục vụ, phần còn lại vẫn đang active (end_date null)
                    'end_date' => $this->faker->boolean(20) ? $this->faker->dateTimeBetween('-6 months', 'now') : null,
                ]);
            }
        }
    }

    private function seedFinance(\Illuminate\Support\Collection $people, User $admin): array
    {
        $funds = collect([
            ['name' => 'Quỹ chung Hội Thánh', 'description' => 'Quỹ vận hành chung của Hội Thánh.'],
            ['name' => 'Quỹ Truyền Giáo', 'description' => 'Dành riêng cho các chuyến truyền giáo.'],
            ['name' => 'Quỹ Xây Dựng', 'description' => 'Dành cho sửa chữa và xây dựng cơ sở vật chất.'],
        ])->map(fn ($f) => Fund::create($f));

        $members = $people->where('person_type', 'member')->values();

        // Contributor cho 15 Member ngẫu nhiên + 5 External
        $contributors = collect();
        foreach ($members->random(min(15, $members->count())) as $person) {
            $contributors->push(Contributor::create([
                'type' => 'member',
                'person_id' => $person->id,
                'name' => $person->name,
                'phone' => $person->phone,
                'email' => $person->email,
            ]));
        }
        for ($i = 0; $i < 5; $i++) {
            $contributors->push(Contributor::create([
                'type' => 'external',
                'name' => $this->faker->name(),
                'phone' => '09'.$this->faker->numerify('########'),
                'email' => $this->faker->safeEmail(),
            ]));
        }

        $incomeCategories = \App\Models\Category::income()->get();
        $expenseCategories = \App\Models\Category::expense()->get();

        // 40 giao dịch income, 20 expense, trải trong 6 tháng gần nhất
        for ($i = 0; $i < 40; $i++) {
            $this->createTransaction('income', $incomeCategories->random(), $funds->random(), $contributors, $admin);
        }
        for ($i = 0; $i < 20; $i++) {
            $this->createTransaction('expense', $expenseCategories->random(), $funds->random(), $contributors, $admin);
        }

        return [$funds, $contributors];
    }

    private function createTransaction(string $type, $category, Fund $fund, \Illuminate\Support\Collection $contributors, User $admin): void
    {
        $status = $this->faker->randomElement(['approved', 'approved', 'approved', 'pending', 'rejected']);

        $transaction = Transaction::create([
            'type' => $type,
            'category_id' => $category->id,
            'fund_id' => $fund->id,
            'contributor_id' => $type === 'income' ? $contributors->random()->id : null,
            'amount' => $this->faker->numberBetween(1, 100) * ($type === 'income' ? 50000 : 200000),
            'description' => $type === 'income' ? 'Dâng hiến '.$this->faker->monthName() : 'Chi phí '.$category->name,
            'transaction_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'status' => 'pending', // set pending trước, approve() sau để field approved_by/at đúng logic
            'created_by' => $admin->id,
        ]);

        if ($status === 'approved') {
            $transaction->approve($admin);
        } elseif ($status === 'rejected') {
            $transaction->reject($admin);
        }
    }

    private function seedEvents(\Illuminate\Support\Collection $people, User $admin): void
    {
        $eventsData = [
            ['name' => 'Trại Hè Thanh Niên 2026', 'days_offset' => 20, 'status' => 'open', 'capacity' => 50],
            ['name' => 'Lễ Bồi Linh Cuối Năm', 'days_offset' => -30, 'status' => 'completed', 'capacity' => 200],
            ['name' => 'Hội Thảo Kỹ Năng Nuôi Dạy Con', 'days_offset' => 10, 'status' => 'open', 'capacity' => 80],
            ['name' => 'Chuyến Truyền Giáo Tây Nguyên', 'days_offset' => 45, 'status' => 'draft', 'capacity' => 30],
            ['name' => 'Chương Trình Giáng Sinh Yêu Thương', 'days_offset' => -5, 'status' => 'completed', 'capacity' => null],
        ];

        foreach ($eventsData as $data) {
            $start = now()->addDays($data['days_offset']);

            $event = Event::create([
                'name' => $data['name'],
                'description' => 'Chương trình '.$data['name'].' dành cho mọi lứa tuổi trong Hội Thánh.',
                'start_date' => $start,
                'end_date' => $start->copy()->addHours(4),
                'location' => 'Hội trường chính Hội Thánh',
                'registration_start' => $start->copy()->subDays(20),
                'registration_end' => $start->copy()->subDays(2),
                'capacity' => $data['capacity'],
                'registration_required' => true,
                'status' => $data['status'],
            ]);

            // Đăng ký ngẫu nhiên 10-20 người
            $registrants = $people->random(min($people->count(), rand(10, 20)));

            foreach ($registrants as $person) {
                $registration = $event->registrations()->create([
                    'person_id' => $person->id,
                    'status' => 'pending',
                ]);

                $outcome = $this->faker->randomElement(['approved', 'approved', 'approved', 'rejected']);

                if ($outcome === 'approved') {
                    $participant = $registration->approve($admin);

                    // Với event đã completed, điểm danh luôn
                    if ($data['status'] === 'completed') {
                        $participant->attendances()->create([
                            'status' => $this->faker->randomElement(['present', 'present', 'present', 'absent']),
                            'attendance_date' => $start,
                        ]);
                    }
                } else {
                    $registration->reject($admin);
                }
            }

            // Thêm 1-3 External Participant do Admin thêm tay
            for ($i = 0; $i < rand(1, 3); $i++) {
                $event->participants()->create([
                    'participant_type' => 'external',
                    'name' => $this->faker->name(),
                    'phone' => '09'.$this->faker->numerify('########'),
                    'email' => $this->faker->safeEmail(),
                    'status' => 'approved',
                ]);
            }
        }
    }

    private function seedNotifications(User $admin): void
    {
        $notifications = [
            ['subject' => 'Lịch Nhóm Thờ Phượng Chủ Nhật', 'status' => 'published'],
            ['subject' => 'Thông Báo Nghỉ Lễ 2/9', 'status' => 'published'],
            ['subject' => 'Mời Tham Gia Trại Hè Thanh Niên', 'status' => 'published'],
            ['subject' => 'Kế Hoạch Sửa Chữa Hội Trường', 'status' => 'draft'],
            ['subject' => 'Thư Mời Họp Ban Chấp Sự', 'status' => 'draft'],
        ];

        foreach ($notifications as $data) {
            $notification = Notification::create([
                'subject' => $data['subject'],
                'time' => now()->addDays(rand(1, 30)),
                'location' => 'Hội trường chính',
                'description' => $this->faker->paragraph(3),
                'status' => 'draft',
                'created_by' => $admin->id,
            ]);

            if ($data['status'] === 'published') {
                $notification->publish();
            }
        }
    }

    private function seedApproverAndUserAccounts(\Illuminate\Support\Collection $people): void
    {
        $members = $people->where('person_type', 'member')->values();

        // 1 tài khoản Approver (vd: thủ quỹ) gắn với 1 Person cụ thể
        if ($members->isNotEmpty()) {
            $treasurer = $members->first();
            User::firstOrCreate(
                ['email' => 'thuquy@church.local'],
                [
                    'name' => $treasurer->name,
                    'person_id' => $treasurer->id,
                    'password' => Hash::make('password'),
                    'role' => 'approver',
                    'status' => 'active',
                ]
            );
        }

        // 3 tài khoản User thường (Member tự đăng nhập xem thông tin cá nhân)
        foreach ($members->skip(1)->take(3) as $index => $person) {
            User::firstOrCreate(
                ['email' => 'member'.($index + 1).'@church.local'],
                [
                    'name' => $person->name,
                    'person_id' => $person->id,
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'status' => 'active',
                ]
            );
        }
    }
}