<style>
    .color-blue-1 {
        color: #00337C;
    }
    .bg-blue-1 {
        background-color: #00337C;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .card-img-1 {
        height: 250px !important;
        object-fit: cover;
        object-position: top center;
    }
    .card-img-2 {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .card-title {
        text-overflow: ellipsis;
    }
    .card-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        line-height: 1.65 !important;
        color: white !important
    }
    .card-text * {
        color: white !important;
       line-height: 1.5 !important;
    }
    .owl-dot {
        background-color: #00337C !important;
    }
    .button-orange {
        background-color: #EE771D;
    }
    .card-prodi {
        position: relative;
        border-radius: 15px;
        width: 310px;
        height: 65%;
        left: 12%;
        top: 80px;
        padding: 30px;
    }
    .img-overlay {
        position: relative;
        border-radius: 15px;
        width: 250px;
        height: 300px;
        object-fit: cover;
        object-position: top center;
        top: -130px;
    }
    .bottom-bg {
        position: relative;
        width: 100vw !important;
        height: 500px;
        background: url("{{ $moss_thumbnail ?? asset('web/images/bottom-bg.png') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        bottom: -80px;
    }
    .bg-content {
        display: flex;
        justify-content: start;
        align-items: center;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        height: 100%;
    }
    .text-shadow {
        text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.5);
    }
</style>
