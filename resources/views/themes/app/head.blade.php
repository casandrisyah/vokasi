<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @foreach ($themes->stylesheet->where('is_active',true) as $item)
        {!!$item->file!!}
    @endforeach
    <style>
        /* [data-kt-app-layout=dark-sidebar] .app-sidebar {
            background-color: #34276f;
            border-right: 0!important;
        }
        [data-kt-app-layout=dark-sidebar] .app-sidebar .menu .menu-item .menu-link.active {
            transition: color .2s ease;
            background-color: #34276f;
            color: var(--bs-primary-inverse);
        } */
        [data-bs-theme=light] {
            --bs-app-bg-color: #90cdea;
            --bs-app-footer-bg-color: #90cdea;
        }
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
        .transition-fade {
            opacity: 1;
            transition-duration: 0.3s;
        }
        html.is-animating .transition-fade {
            opacity: 0;
            transform: translateY(-10px);
        }

    </style>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <title>{{config('app.name') . ': ' .$title ?? config('app.name')}}</title>
</head>
