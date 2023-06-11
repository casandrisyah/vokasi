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
    $(document).on('click', '.page-link.teaching', function(event) {
        event.preventDefault();
        $(".page-link.teaching").removeClass("active");
        $(event.currentTarget).parent(".page-link.teaching").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_teaching(page);
    });
    $(document).on('click', '.page-link.fpa', function(event) {
        event.preventDefault();
        $(".page-link.fpa").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpa").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpa(page);
    });
    $(document).on('click', '.page-link.fpt', function(event) {
        event.preventDefault();
        $(".page-link.fpt").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpt").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpt(page);
    });
    $(document).on('click', '.page-link.research', function(event) {
        event.preventDefault();
        $(".page-link.research").removeClass("active");
        $(event.currentTarget).parent(".page-link.research").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_research(page);
    });
    $(document).on('click', '.page-link.sf', function(event) {
        event.preventDefault();
        $(".page-link.sf").removeClass("active");
        $(event.currentTarget).parent(".page-link.sf").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_sf(page);
    });
    $(document).on('click', '.page-link.rd', function(event) {
        event.preventDefault();
        $(".page-link.rd").removeClass("active");
        $(event.currentTarget).parent(".page-link.rd").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_rd(page);
    });
    $(document).on('click', '.page-link.teaching-dekan', function(event) {
        event.preventDefault();
        $(".page-link.teaching-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.teaching-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_teaching_dekan(page);
    });
    $(document).on('click', '.page-link.fpa-dekan', function(event) {
        event.preventDefault();
        $(".page-link.fpa-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpa-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpa_dekan(page);
    });
    $(document).on('click', '.page-link.fpt-dekan', function(event) {
        event.preventDefault();
        $(".page-link.fpt-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpt-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpt_dekan(page);
    });
    $(document).on('click', '.page-link.research-dekan', function(event) {
        event.preventDefault();
        $(".page-link.research-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.research-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_research_dekan(page);
    });
    $(document).on('click', '.page-link.sf-dekan', function(event) {
        event.preventDefault();
        $(".page-link.sf-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.sf-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_sf_dekan(page);
    });
    $(document).on('click', '.page-link.rd-dekan', function(event) {
        event.preventDefault();
        $(".page-link.rd-dekan").removeClass("active");
        $(event.currentTarget).parent(".page-link.rd-dekan").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_rd_dekan(page);
    });
    $(document).on('click', '.page-link.teaching-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.teaching-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.teaching-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_teaching_kaprodi(page);
    });
    $(document).on('click', '.page-link.fpa-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.fpa-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpa-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpa_kaprodi(page);
    });
    $(document).on('click', '.page-link.fpt-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.fpt-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.fpt-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_fpt_kaprodi(page);
    });
    $(document).on('click', '.page-link.research-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.research-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.research-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_research_kaprodi(page);
    });
    $(document).on('click', '.page-link.sf-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.sf-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.sf-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_sf_kaprodi(page);
    });
    $(document).on('click', '.page-link.rd-kaprodi', function(event) {
        event.preventDefault();
        $(".page-link.rd-kaprodi").removeClass("active");
        $(event.currentTarget).parent(".page-link.rd-kaprodi").addClass("active");
        const page = $(event.currentTarget).data("halaman").split("page=")[1];
        load_rd_kaprodi(page);
    });
});

function load_teaching(page){
    $.get('/office/fed/teaching?page=' + page, function(result) {
        $('#list_teaching').html(result);
    }, "html");
}
function load_fpa(page){
    $.get('/office/fed/final-project-advisor?page=' + page, function(result) {
        $('#list_fpa').html(result);
    }, "html");
}
function load_fpt(page){
    $.get('/office/fed/final-project-tester?page=' + page, function(result) {
        $('#list_fpt').html(result);
    }, "html");
}
function load_sf(page){
    $.get('/office/fed/scientific-work?page=' + page, function(result) {
        $('#list_sf').html(result);
    }, "html");
}
function load_research(page){
    $.get('/office/fed/research-result?page=' + page, function(result) {
        $('#list_research').html(result);
    }, "html");
}
function load_rd(page){
    $.get('/office/fed/result-dev?page=' + page, function(result) {
        $('#list_rd').html(result);
    }, "html");
}

function load_teaching_dekan(page){
    $.get('/office/dekan/teaching?page=' + page, function(result) {
        $('#list_teaching_dekan').html(result);
    }, "html");
}
function load_fpa_dekan(page){
    $.get('/office/dekan/final-project-advisor?page=' + page, function(result) {
        $('#list_fpa_dekan').html(result);
    }, "html");
}
function load_fpt_dekan(page){
    $.get('/office/dekan/final-project-tester?page=' + page, function(result) {
        $('#list_fpt_dekan').html(result);
    }, "html");
}
function load_sf_dekan(page){
    $.get('/office/dekan/scientific-work?page=' + page, function(result) {
        $('#list_sf_dekan').html(result);
    }, "html");
}
function load_research_dekan(page){
    $.get('/office/dekan/research-result?page=' + page, function(result) {
        $('#list_research_dekan').html(result);
    }, "html");
}
function load_rd_dekan(page){
    $.get('/office/dekan/result-dev?page=' + page, function(result) {
        $('#list_rd_dekan').html(result);
    }, "html");
}

function load_teaching_kaprodi(page){
    $.get('/office/kaprodi/teaching?page=' + page, function(result) {
        $('#list_teaching_kaprodi').html(result);
    }, "html");
}
function load_fpa_kaprodi(page){
    $.get('/office/kaprodi/final-project-advisor?page=' + page, function(result) {
        $('#list_fpa_kaprodi').html(result);
    }, "html");
}
function load_fpt_kaprodi(page){
    $.get('/office/kaprodi/final-project-tester?page=' + page, function(result) {
        $('#list_fpt_kaprodi').html(result);
    }, "html");
}
function load_sf_kaprodi(page){
    $.get('/office/kaprodi/scientific-work?page=' + page, function(result) {
        $('#list_sf_kaprodi').html(result);
    }, "html");
}
function load_research_kaprodi(page){
    $.get('/office/kaprodi/research-result?page=' + page, function(result) {
        $('#list_research_kaprodi').html(result);
    }, "html");
}
function load_rd_kaprodi(page){
    $.get('/office/kaprodi/result-dev?page=' + page, function(result) {
        $('#list_rd_kaprodi').html(result);
    }, "html");
}

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
