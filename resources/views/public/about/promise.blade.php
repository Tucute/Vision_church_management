@extends('layouts.public', ['churchInfo' => $churchInfo])

@section('title', 'Our Promise — ' . $churchInfo->name)

@section('content')
<section class="ui-section">
    <x-public.container width="reading">
        <x-public.page-header
            title="Our Promise"
            lead="Hai điều chúng tôi muốn nói thật với bạn trước khi bạn gắn bó với nhà này."
            :back-href="route('about')"
            back-label="Về trang giới thiệu"
        />

        <div class="space-y-6">
            <x-public.info-card title="Trước hết" eyebrow="First">
                <p class="ui-body">
                    Ở {{ $churchInfo->name }}, rất có thể bạn sẽ bị chạm đến — ít nhất một lần. Chúng tôi đến từ nhiều hoàn cảnh và cách nhìn khác nhau. Khi sống gần nhau, hiểu lầm có thể xảy ra. Những lúc ấy là cơ hội để trao lại ân điển và sự khiêm nhường mà Chúa đã dành cho từng người.
                </p>
            </x-public.info-card>
            <x-public.info-card title="Và điều thứ hai" eyebrow="Second">
                <p class="ui-body">
                    Chúng tôi không hứa bạn sẽ thích mọi điều Hội Thánh làm. Nếu bạn đang tìm một hội thánh hoàn hảo, đây không phải nơi đó. Thuộc về một gia đình đức tin là để tôn vinh Chúa và chúc phước cho người khác, không chỉ để vừa ý riêng mình. Sẽ có ngày bài hát hay bài giảng không đúng sở thích của bạn. Khi yêu Chúa và yêu người hơn chính mình, bạn sẽ có chỗ để ở lại. Hội Thánh chưa hoàn hảo, nhưng đây là nơi đời sống đang được biến đổi bởi tình yêu của Chúa Giê-xu.
                </p>
            </x-public.info-card>
        </div>
    </x-public.container>
</section>
@endsection
