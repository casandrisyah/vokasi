@guest
    @foreach ($themes->javascript->where("is_active",true)->where("is_guest",true) as $item)
        @if($item->is_editable == 1)
            <script type="text/javascript">
                {!!$item->file!!}
            </script>
        @else
            {!!$item->file!!}
        @endif
    @endforeach
@endguest
@auth
    @foreach ($themes->javascript->where("is_active",true)->where("is_auth",true) as $item)
        @if($item->is_editable == 1)
            <script type="text/javascript">
                {!!$item->file!!}
            </script>
        @else
            {!!$item->file!!}
        @endif
    @endforeach
@endauth

<script src="{{ asset("web/js/jquery.js") }}"></script>
<script src="{{ asset("web/js/plugins.js") }}"></script>
<script src="{{ asset("web/js/functions.js") }}"></script>
{{-- <script src="{{ asset("web/js/methods.js") }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
<script src="{{ asset("owl-carousel/dist/owl.carousel.min.js") }}"></script>
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            items: 3,
            loop: false,
            autoplay: true,
            autoplayTimeout: 10000,
            autoplaySpeed: 800,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                700: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
        }
    });
    document.getElementById("submit-comment").addEventListener("click", function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ route("web.send-comment") }}",
            type: "POST",
            data: {
                body: $("input[name=body]").val(),
            },
            success: function(response) {
                if (response.alert == "success") {
                    $("#comment-form").trigger("reset");
                    window.location.reload();
                } else {
                    $("#comment-form").trigger("reset");
                    window.location.reload();
                }
            },
        });
    });

</script>
