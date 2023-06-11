var app_name = "Dana Cepat: ";
var path = window.location.href.split("/").pop();
$("body").on("contextmenu", "img", function(e) {
    return false;
});
const toastElement = document.getElementById('notification');
const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
$('img').attr('draggable', false);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#form_login").on('keydown', 'input', function (event) {
    if (event.which == 9 || event.which == 13) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-login'));
        var val = $($this).val();
        if(index == 1){
            if(val.length > 0){
                var validateMail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!validateMail.test(val)){
                    // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
                    $("#toast_body").html($($this).data('format'));
                    toast.show();
                }else{
                    $('[data-login="' + (index + 1).toString() + '"]').focus();
                }
            }else{
                $("#toast_body").html($($this).data('validation'));
                toast.show();
            }
        }else{
            $('#tombol_login').trigger("click");
        }
    }
});
$("#form_forgot").on('keydown', 'input', function (event) {
    if (event.which == 9 || event.which == 13) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-forgot'));
        var val = $($this).val();
        console.log(lang);
        if(index == 1){
            if(val.length > 0){
                var validateMail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!validateMail.test(val)){
                    // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
                    $("#toast_body").html($($this).data('format'));
                    toast.show();
                }else{
                    $('[data-forgot="' + (index + 1).toString() + '"]').focus();
                }
            }else{
                $("#toast_body").html($($this).data('validation'));
                toast.show();
            }
        }else{
            $('#tombol_forgot').trigger("click");
        }
    }
});

const handle_post = (tombol, form) => {
    $(document).one('submit', form, (e) => {
        let lang = localStorage.getItem("cms_lang");
        const data = new FormData(e.target);
        data.append('_method', 'POST');
        $(tombol).prop("disabled", true);
        $(tombol).attr("data-kt-indicator","on");
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            resetForm: true,
            processData: false,
            dataType: 'json',
            beforeSend: () => {},
            success: (response) => {
                toast.show();
                $(tombol).prop("disabled", false);
                $(tombol).removeAttr("data-kt-indicator");
                if (response.alert === "success") {
                    let message = response.message;
                    $("#toast_body").html(message);
                    setTimeout(() => {
                        location.reload();
                        // swup.loadPage({
                        //     url: $(form).data('redirect-url'), // route of request (defaults to current url)
                        //     // method: 'GET', // method of request (defaults to "GET")
                        //     // data: data, // data passed into XMLHttpRequest send method
                        //     // customTransition: '' // name of your transition used for adding custom class to html element and choosing custom animation in swupjs (as setting data-swup-transition attribute on link)
                        // });
                    }, 1000);
                }else{
                    let messages = response.message;
                    $("#toast_body").html(messages);
                }
            },
        });
        return false;
    });
};

const options = {
    containers: ['#cms_app'],
    doScrollingRightAway: true,
    animateHistoryBrowsing: true,
    animationSelector: '[class="div-cover"]',
    linkSelector: '.menu-link:not([data-no-swup]), .menu-item:not([data-no-swup]), .nav-link:not([data-no-swup])',
};
const swup = new Swup(options);
document.addEventListener("swup:contentReplaced", () => {
    $("body").on("contextmenu", "img", function(e) {
        return false;
    });
    const toastElement = document.getElementById('notification');
    const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
    $('img').attr('draggable', false);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let lang = localStorage.getItem("cms_lang");
    $("#form_login").on('keydown', 'input', function (event) {
        if (event.which == 9 || event.which == 13) {
            event.preventDefault();
            var $this = $(event.target);
            var index = parseFloat($this.attr('data-login'));
            var val = $($this).val();
            if(index == 1){
                console.log(lang);
                if(val.length > 0){
                    var validateMail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!validateMail.test(val)){
                        // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
                        $("#toast_body").html($($this).data('format'));
                        toast.show();
                    }else{
                        $('[data-login="' + (index + 1).toString() + '"]').focus();
                    }
                }else{
                    $("#toast_body").html($($this).data('validation'));
                    toast.show();
                }
            }else{
                $('#tombol_login').trigger("click");
            }
        }
    });
});
swup.on('animationInDone', function() {
    // Fokus pada inputan dengan id "myInput"
    document.getElementById("email").focus();
});