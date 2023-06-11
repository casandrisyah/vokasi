<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppearanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            ['name' => 'Canvas', 'slug' => Str::slug('canvas'), 'authors' => 'Semicolon', 'thumbnail' => 'theme/semicolon.jpg' , 'is_active' => true, 'is_admin' => false, 'is_swup' => true],
            ['name' => 'Metronic', 'slug' => Str::slug('metronic'), 'authors' => 'Keenthemes' , 'thumbnail' => 'theme/keenthemes.png', 'is_active' => true, 'is_admin' => true, 'is_swup' => true],
        ]);
        DB::table('theme_stylesheets')->insert([
            ['theme_id' => 1, 'file' => '<meta http-equiv="content-type" content="text/html; charset=utf-8">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<meta http-equiv="x-ua-compatible" content="IE=edge">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="preconnect" href="https://fonts.googleapis.com">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=PT+Serif:ital@0;1&display=swap" rel="stylesheet">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/semicolon/canvas/style.css" type="text/css">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/semicolon/canvas/css/font-icons.css" type="text/css">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/semicolon/canvas/css/swiper.css" type="text/css">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/semicolon/canvas/css/custom.css" type="text/css">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 1, 'file' => '<meta name="viewport" content="width=device-width, initial-scale=1">','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<meta charset="utf-8" />','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<meta name="viewport" content="width=device-width, initial-scale=1" />','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/keenthemes/metronic8/1/plugins/global/plugins.bundle.css" type="text/css" />','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/keenthemes/metronic8/1/css/style.bundle.css" type="text/css" />','is_active' => true, 'is_editable' => false],
            // ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://cdn.yadaekidanta.com/plugins/summernote/summernote.min.css" type="text/css" />','is_active' => true, 'is_editable' => false],
            // ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" type="text/css" />','is_active' => true, 'is_editable' => false],
            ['theme_id' => 2, 'file' => '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.css" type="text/css" />','is_active' => true, 'is_editable' => false],
        ]);
        DB::table('theme_javascripts')->insert([
            ['theme_id' => 1, 'file' => '<script src="https://cdn.yadaekidanta.com/semicolon/canvas/js/functions.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 1, 'file' => '
            if (document.getElementsByClassName("change-cursor-style") !== null) {
                document.querySelector(".change-cursor-style").onclick = e => {e.preventDefault();document.querySelector(".cnvs-cursor").classList.toggle("cnvs-cursor-border");};
            }
            ', 'is_active' => true, 'is_editable' => true, 'is_guest' => true, 'is_auth' => false],
            ['theme_id' => 1, 'file' => '<script src="https://cdn.yadaekidanta.com/plugins/swup/swup.min.js"></script>', 'is_active' => false, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 1, 'file' => 'var plugin','is_active' => true, 'is_editable' => true, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 1, 'file' => 'var method','is_active' => true, 'is_editable' => true, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 1, 'file' => '
            const options = {
                containers: [".cms_web"],
                doScrollingRightAway: true,
                animateHistoryBrowsing: true,
                animationSelector: "[class=div-cover]",
                linkSelector: ".menu-link:not([data-no-swup]), .menu-item:not([data-no-swup]), .nav-link:not([data-no-swup])",
            };
            const swup = new Swup(options);
            document.addEventListener("swup:contentReplaced", () => {
                var script = document.createElement("script");
                script.src = "/web/js/plugins.js";
                document.body.appendChild(script);
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
                        url: "/send-comment",
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

                $(`#filter-category`).change(function() {
                    category = $(this).val();
                    var dosen_id = $(`#dosen_id`).val();
                    var card = $(`#card-teaching-mentoring`);
                    card.empty();
                    filterTeachingMentoring(category, dosen_id);
                });

                function filterTeachingMentoring(category, dosen_id) {
                    $.ajax({
                        url: "/teaching-mentoring-filter",
                        method: `GET`,
                        data: {
                            category: category,
                            dosen_id: dosen_id
                        },
                        dataType: `json`,
                        success: function(response) {
                            if (response.status === `success`) {
                                $(`#card-teaching-mentoring .card`).remove();
                                response.data.forEach(function(item, index) {
                                    var cardHtml = `<div class="card rounded-6 my-shadow border-0 mt-3 ` + (index === response.data.length - 1 ? `mb-3` : ``) + `">` +
                                        `<div class="card-body">` +
                                        `<span class="text-uppercase fw-light" style="font-size: 12px">` + item.category + `</span>` +
                                        `<div class="fw-semibold" style="font-size: 17px; text-transform: capitalize">` + item.title + `</div>` +
                                        `<div class="text-muted">` + (item.student_name ? `Mahasiswa: ` + item.student_name : ``) + `</div>` +
                                        `<div class="text-muted mt-1 fw-light">` + item.year + `</div>` +
                                        `</div>` +
                                        `</div>`;

                                    $(`#card-teaching-mentoring`).append(cardHtml);
                                });
                            } else {
                                var message = `<span class="text-muted fw-light">Belum ada pengajaran dan pembimbingan yang ditambahkan</span>`;
                                $(`#card-teaching-mentoring`).append(message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
            swup.on("animationInDone", function() {
            });','is_active' => true, 'is_editable' => true, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '
            var defaultThemeMode = "light";
            var themeMode;
            if ( document.documentElement ) {
                if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if ( localStorage.getItem("data-bs-theme") !== null ) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
            ', 'is_active' => true, 'is_editable' => true, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script src="https://cdn.yadaekidanta.com/keenthemes/metronic8/1/plugins/global/plugins.bundle.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script src="https://cdn.yadaekidanta.com/keenthemes/metronic8/1/js/scripts.bundle.js"></script>','is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script src="https://cdn.yadaekidanta.com/plugins/swup/swup.min.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            // ['theme_id' => 2, 'file' => '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            // ['theme_id' => 2, 'file' => '<script src="https://cdn.yadaekidanta.com/plugins/summernote/summernote.min.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            // ['theme_id' => 2, 'file' => '<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.js"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script src="'.asset('app/js/auth.js').'"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => true, 'is_auth' => false],
            ['theme_id' => 2, 'file' => '<script type="text/javascript" src="'.asset('app/js/plugin.js').'"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => false, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '<script type="text/javascript" src="'.asset('app/js/method.js').'"></script>', 'is_active' => true, 'is_editable' => false, 'is_guest' => false, 'is_auth' => true],
            ['theme_id' => 2, 'file' => '
            var app_name = "Del: ";
            document.addEventListener("swup:contentReplaced", () => {
                if (document.getElementById("div_show") !== null) {
                    $("#div_show").hide();
                    if($("#jenis_kegiatan").val() == "Online") {
                        $("#div_show").show();
                        $("#title").text("Link Pertemuan");
                    } else {
                        $("#div_show").show();
                        $("#title").text("Tempat Pelaksanaan");
                    }
                    $("#jenis_kegiatan").change(function() {
                        if ($(this).val() == "Online") {
                            $("#div_show").show();
                            $("#title").text("Link Pertemuan");
                        } else if ($(this).val() == "Offline") {
                            $("#div_show").show();
                            $("#title").text("Tempat Pelaksanaan");
                        } else {
                            $("#div_show").hide();
                        }
                    });
                }

                if ($("#subject_id").length > 0) {
                    $("#subject_id").on("change", function() {
                        $("#sks").val($("#subject_id option:selected").attr("data-sks"));
                    });
                }

                obj_date("date_birth");
                obj_date_time("tanggal");
                obj_date("testing_time");
                obj_date("published1");
                obj_date("published2");
                obj_date_range("working_time");
                obj_select("carousel_url")
                obj_select("year_check");
                obj_select("semester");
                obj_select("category");
                obj_select("dosen_position");
                obj_select("staf_position");
                obj_select("select_prodi");
                obj_select("agreement");
                obj_select("select_role");
                obj_select("jenis_kegiatan");
                obj_select("subject_id");
                obj_select("subject_id2");
                obj_select("subject_id3");
                obj_select("funding_type");
                obj_select("tested_component_id");
                obj_select("tester_position_id");
                obj_select("footer_section")

                load_list(1);
                if (document.getElementById("list_teaching_frk") !== null) {
                    load_teaching_frk(1);
                    load_fpa_frk(1);
                    load_fpt_frk(1);
                    load_clp_frk(1);
                }
                if (document.getElementById("list_teaching") !== null) {
                    load_teaching(1);
                    load_fpa(1);
                    load_fpt(1);
                    load_research(1);
                    load_sf(1);
                    load_rd(1);
                }
                if (document.getElementById("list_teaching_dekan") !== null) {
                    load_teaching_dekan(1);
                    load_fpa_dekan(1);
                    load_fpt_dekan(1);
                    load_research_dekan(1);
                    load_sf_dekan(1);
                    load_rd_dekan(1);
                }
                if (document.getElementById("list_teaching_kaprodi") !== null) {
                    load_teaching_kaprodi(1);
                    load_fpa_kaprodi(1);
                    load_fpt_kaprodi(1);
                    load_research_kaprodi(1);
                    load_sf_kaprodi(1);
                    load_rd_kaprodi(1);
                }
                if (document.getElementById("list_teaching_history") !== null) {
                    load_teaching_history(1);
                    load_fpa_history(1);
                    load_fpt_history(1);
                    load_research_history(1);
                    load_sf_history(1);
                    load_rd_history(1);
                }

                $("body").on("contextmenu", "img", function(e) {
                    return false;
                });
                $("img").attr("draggable", false);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
                    }
                });
                $(".menu-item a").each(function() {
                    let menuLink = $(this).attr("href");
                    let currentUrl = window.location.href;
                    let regex = new RegExp(menuLink);
                    let menuLink2 = $(this).attr("href") + "/.*";
                    let regex2 = new RegExp(menuLink2);

                    if (regex.test(currentUrl) || regex2.test(currentUrl)) {
                        $(this).addClass("active");
                    } else {
                        $(this).removeClass("active");
                    }
                });
                if ($("#name").length > 0 && $("#slug").length > 0) {
                    $("#name").on("input", function() {
                        $("#slug").val($(this).val().toLowerCase()
                            .trim()
                            .replace(/[^\w\s-]/g, "")
                            .replace(/[\s_-]+/g, "-")
                            .replace(/^-+|-+$/g, ""));
                    });
                }
                if ($("#avatar").length > 0) {
                    $("#avatar").change(function(e) {
                        e.preventDefault();
                        if ($("#avatar-image").attr("src") === "") {
                            $("#avatar-image").removeClass("d-none")
                        }
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            $("#avatar-image").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    });
                }
                if ($("#thumbnail").length > 0) {
                    $("#thumbnail").change(function(e) {
                        e.preventDefault();
                        if ($("#thumbnail-preview").attr("src") === "") {
                            $("#thumbnail-preview").removeClass("d-none")
                        }
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            $("#thumbnail-preview").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    });
                }
            });', 'is_active' => true, 'is_editable' => true, 'is_guest' => false, 'is_auth' => true],
        ]);
    }
}
