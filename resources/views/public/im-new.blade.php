@extends('layouts.public')

@section('title', 'Người mới — ' . (\App\Models\ChurchInfo::current()->name ?? 'Hội Thánh'))

@section('content')
<section class="ui-section">
    <x-public.container width="narrow">
        <x-public.reveal>
            <x-public.page-header
                title="Chào mừng bạn!"
                lead="Chúng tôi rất vui khi bạn quan tâm đến Hội Thánh. Hãy để lại vài thông tin bên dưới, đội ngũ của chúng tôi sẽ sớm liên lạc và đồng hành cùng bạn."
            />
        </x-public.reveal>

        <x-public.reveal delay="1">
            <form method="POST" action="{{ route('im-new.store') }}" class="ui-card space-y-4 p-6 shadow-md sm:p-8">
                @csrf

                <x-public.form-field name="name" label="Họ và tên" required autocomplete="name" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-public.form-field name="phone" label="Số điện thoại" type="tel" autocomplete="tel" />
                    <x-public.form-field name="email" label="Email" type="email" autocomplete="email" />
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-public.form-field name="gender" label="Giới tính" type="select">
                        <option value="">-- Chọn --</option>
                        <option value="male" @selected(old('gender') === 'male')>Nam</option>
                        <option value="female" @selected(old('gender') === 'female')>Nữ</option>
                        <option value="other" @selected(old('gender') === 'other')>Khác</option>
                    </x-public.form-field>
                    <x-public.form-field name="date_of_birth" label="Ngày sinh" type="date" />
                </div>

                <x-public.form-field name="address" label="Địa chỉ" autocomplete="street-address" />
                <x-public.form-field name="message" label="Lời nhắn (tuỳ chọn)" type="textarea" :rows="3" />

                <x-public.button type="submit" variant="primary" block>
                    Gửi thông tin
                </x-public.button>
            </form>
        </x-public.reveal>
    </x-public.container>
</section>
@endsection
