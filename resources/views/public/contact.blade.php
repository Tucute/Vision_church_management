@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Liên hệ — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="content">
        <div class="grid gap-10 lg:grid-cols-2">
            <x-public.reveal>
                <x-public.page-header
                    title="Liên hệ"
                    lead="Có câu hỏi hoặc cần hỗ trợ? Gửi tin nhắn cho chúng tôi, đội ngũ sẽ phản hồi sớm nhất."
                />
                <x-public.info-card eyebrow="Thông tin liên hệ" class="mt-2">
                    <x-public.contact-info :church-info="$churchInfo" />
                </x-public.info-card>
            </x-public.reveal>

            <x-public.reveal delay="1">
                <form method="POST" action="{{ route('contact.store') }}" class="ui-card space-y-4 p-6 shadow-md sm:p-8">
                    @csrf

                    <x-public.form-field name="name" label="Họ và tên" required autocomplete="name" />
                    <x-public.form-field name="email" label="Email" type="email" required autocomplete="email" />
                    <x-public.form-field name="phone" label="Số điện thoại" type="tel" autocomplete="tel" />
                    <x-public.form-field name="subject" label="Chủ đề" />
                    <x-public.form-field name="message" label="Nội dung" type="textarea" required :rows="4" />

                    <x-public.button type="submit" variant="primary" block>
                        Gửi tin nhắn
                    </x-public.button>
                </form>
            </x-public.reveal>
        </div>
    </x-public.container>
</section>
@endsection
