var path = window.location.href.split("/").pop();
$("body").on("contextmenu", "img", function(e) {
    return false;
});
const toastElement = document.getElementById("notification");
const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
$("img").attr("draggable", false);
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
    }
});
$(document).ready(() => {
    $(document).on("click", ".page-link.default", (event) => {
        event.preventDefault();
        $(".page-link.default").removeClass("active");
        $(event.currentTarget).parent(".page-link.default").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_list(page);
    });
});

const load_list = (page) => {$.get(`?page=${page}`,$("#content_filter").serialize() , (result) => {$("#list_result").html(result);}, "html");}
const handle_post_reorderby = (form, page, id, order) => {
    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: {
            page_id: page,
            id: id,
            order: order
        },
        success: function (response) {
            if (response.alert === "success") {
                toast.show();
                let message = response.message;
                $("#toast_body").html(message);
            }
        },
        error: function (xhr, status, error) {
            // console.log(xhr.responseText);
        }
    });
};
const handle_post = (tombol, form) => {
    $(document).one("submit", form, (e) => {
        // loading();
        let lang = localStorage.getItem("cms_lang");
        const data = new FormData(e.target);
        data.append("_method", $(form).attr("method"),);
        $(tombol).prop("disabled", true);
        $(tombol).attr("data-kt-indicator","on");
        $.ajax({
            type: "POST",
            url: $(form).attr("action"),
            data: data,
            enctype: "multipart/form-data",
            cache: false,
            contentType: false,
            resetForm: true,
            processData: false,
            dataType: "json",
            beforeSend: () => {},
            success: (response) => {
                toast.show();
                $(tombol).prop("disabled", false);
                $(tombol).removeAttr("data-kt-indicator");
                // loaded();
                if (response.alert === "success") {
                    let message = response.message;
                    $("#toast_body").html(message);
                    setTimeout(() => {
                        swup.loadPage({
                            url: $(form).data("redirect-url"), // route of request (defaults to current url)
                        });
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
const handle_login_web = (tombol, form) => {
    $(document).one("submit", form, (e) => {
        // loading();
        let lang = localStorage.getItem("cms_lang");
        const data = new FormData(e.target);
        data.append("_method", $(form).attr("method"),);
        $(tombol).prop("disabled", true);
        $(tombol).attr("data-kt-indicator","on");
        $.ajax({
            type: "POST",
            url: $(form).attr("action"),
            data: data,
            enctype: "multipart/form-data",
            cache: false,
            contentType: false,
            resetForm: true,
            processData: false,
            dataType: "json",
            beforeSend: () => {},
            success: (response) => {
                toast.show();
                $(tombol).prop("disabled", false);
                $(tombol).removeAttr("data-kt-indicator");
                // loaded();
                if (response.alert === "success") {
                    let message = response.message;
                    $("#toast_body").html(message);
                    setTimeout(() => {
                        swup.loadPage({
                            url: $(form).data("redirect-url"), // route of request (defaults to current url)
                        });
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
function handle_confirm(method, route, tombol){
    Swal.fire({
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        },
        position: 'top-end',
        title: 'Apakah Anda yakin ingin konfirmasi?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Ya',
        denyButtonText: 'Tidak',
    }).then((result) => {
        if (result.isConfirmed) {
            loading();
            $.ajax({
                type: method,
                url: route,
                dataType: 'json',
                success: function(response) {
                    loaded();
                    if(response.alert == "success"){
                        let message = response.message;
                        $("#toast_body").html(message);
                    }else{
                        let message = response.message;
                        $("#toast_body").html(message);
                    }
                    setTimeout(() => {
                        // window.history.pushState(null, null, $(form).data('redirect-url'));
                        // swup.preloadPage($(form).data('redirect-url'));
                        swup.loadPage({
                            url: $(tombol).data('redirect-url'), // route of request (defaults to current url)
                            // method: 'GET', // method of request (defaults to "GET")
                            // data: data, // data passed into XMLHttpRequest send method
                            // customTransition: '' // name of your transition used for adding custom class to html element and choosing custom animation in swupjs (as setting data-swup-transition attribute on link)
                        });
                    }, 1000);
                },
                error: function(xhr) {
                    handle_error(xhr);
                },
            });
        } else if (result.isDenied) {
            $("#toast_body").html('Anda membatalkan konfirmasi');
            // custom_message(response.alert,response.message);
        }
    });
}
const options = {
    containers: ["#cms_app"],
    cache: false,
    doScrollingRightAway: true,
    animateHistoryBrowsing: true,
    animationSelector: ".transition-fade",
    linkSelector: ".menu-link:not([data-no-swup]), .menu-item:not([data-no-swup]), .nav-link:not([data-no-swup]), .menu-sub:not([data-no-swup]) > .menu-item > .menu-link",
};
const swup = new Swup(options);
