<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @foreach ($themes->stylesheet->where('is_active',true) as $item)
        {!!$item->file!!}
    @endforeach
    <link rel="stylesheet" href="{{ asset('owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owl-carousel/dist/assets/owl.theme.default.min.css') }}">
    <style>
        .photos{
            width:100%;
            aspect-ratio:8/2;
            object-fit:contain;
            /* mix-blend-mode: color-burn; */
        }
        .truncate {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
    @if (request()->is('tentang-kami'))
    <link rel="stylesheet" href="{{ asset('web/css/timline-custom.css') }}">
    @endif
    <title>{{config('app.name') . ': ' .$title ?? config('app.name')}}</title>
</head>
