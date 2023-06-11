$('.number_only').bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
$('.format_email').bind('keypress', function (event) {
    var regex = new RegExp("^[A-Za-z0-9@_.]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});
Inputmask({
    "mask": "99.999.999.9-999.999"
}).mask(".npwp_format");

function format_ribuan(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$('.ribuan').keyup(function (event) {
    if (event.which >= 37 && event.which <= 40) return;
    // format number
    $(this).val(function (index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
    var id = $(this).data("id-selector");
    var classs = $(this).data("class-selector");
    var value = $(this).val();
    var noCommas = value.replace(/,/g, "");
    $('#' + id).val(noCommas);
    $('.' + classs).val(noCommas);
});

function obj_tinymce(obj) {
    var options = {selector: "#"+obj, height : "480"};

    if ( KTThemeMode.getMode() === "dark" ) {
        options["skin"] = "oxide-dark";
        options["content_css"] = "dark";
    }

    tinymce.init(options);
}
function obj_quill_language_program(obj, lang) {
    hljs.highlightAll();
    // Configure hljs to highlight only the specified language
    hljs.configure({languages: [lang]});

    var quill = new Quill('#' + obj, {
        modules: {
                syntax: true,               // Enable syntax module
            toolbar: [[]]  // Include button in toolbar
        },
        placeholder: 'Type your text here...',
        theme: 'snow' // or 'bubble'
    });

    // Set the language of the code block to the specified language
        quill.format('code-block', lang);

    quill.on('text-change', function (delta, oldDelta, source) {
            document.querySelector("textarea[name='" + obj + "']").value = quill.getText();
    });
}
function obj_summernote(obj){
    $('#'+obj).summernote({
        // toolbar: [
        //     // [groupName, [list of button]]
        //     // ['style', ['bold', 'italic', 'underline', 'clear']],
        //     // ['font', ['strikethrough', 'superscript', 'subscript']],
        //     // ['fontsize', ['fontsize']],
        //     // ['color', ['color']],
        //     // ['para', ['ul', 'ol', 'paragraph']],
        //     // ['height', ['height']]
        // ],
        // codeview: true
        // other options...
    });
}
function obj_summernote_css(obj){
    $('#'+obj).summernote({
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        }
        // toolbar: [
        //     // [groupName, [list of button]]
        //     // ['style', ['bold', 'italic', 'underline', 'clear']],
        //     // ['font', ['strikethrough', 'superscript', 'subscript']],
        //     // ['fontsize', ['fontsize']],
        //     // ['color', ['color']],
        //     // ['para', ['ul', 'ol', 'paragraph']],
        //     // ['height', ['height']]
        // ],
        // codeview: true
        // other options...
    });
}
function obj_summernote_js(obj){
    $('#'+obj).summernote({
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai'
        }
        // toolbar: [
        //     // [groupName, [list of button]]
        //     // ['style', ['bold', 'italic', 'underline', 'clear']],
        //     // ['font', ['strikethrough', 'superscript', 'subscript']],
        //     // ['fontsize', ['fontsize']],
        //     // ['color', ['color']],
        //     // ['para', ['ul', 'ol', 'paragraph']],
        //     // ['height', ['height']]
        // ],
        // codeview: true
        // other options...
    });
}
function obj_quill(obj) {
    // var fonts = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
    // var Font = Quill.import('formats/font');
    // Font.whitelist = fonts;
    var quill = new Quill('#' + obj, {
        placeholder: 'Type your text here...',
        modules: {
            'syntax': true,
            'toolbar': [
                [ 'font', { 'size': [] }],
                [ 'bold', 'italic', 'underline', 'strike' ],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
                [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                [ {'direction': 'rtl'}, { 'align': [] }],
                [ 'link', 'image', 'video', 'formula' ],
                [ 'clean' ]
            ],
        },
        theme: 'snow' // or 'bubble'
    });
    quill.on('text-change', function (delta, oldDelta, source) {
        document.querySelector("textarea[name='"+obj+"']").value = quill.root.innerHTML;
    });
}
function obj_ckeditor(obj) {
    ClassicEditor.create(document.querySelector('#' + obj)).then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
}

function obj_autosize(obj) {
    autosize($('#' + obj));
}

function obj_time(obj) {
    $("#" + obj).flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
}

function obj_date_time(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d H:i",
        enableTime: true,
    });
}
function obj_date_timenow(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d H:i",
        enableTime: true,
        minDate: "today"
    });
}
function obj_date(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
    });
}
function obj_birthdate(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
        maxDate: new Date().fp_incr(-6209)
    });
}

function obj_year(obj) {
    $("#" + obj).flatpickr({
        plugins: [new monthSelectPlugin({
            shorthand: true,
            dateFormat: "Y",
            altFormat: "Y"
        })]
    });
}

function obj_startdatenow(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
        minDate: "today"
    });
}

function obj_enddatenow(obj) {
    $("#" + obj).flatpickr({
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
}

function obj_date_range(obj) {
    $("#" + obj).daterangepicker();
}

function obj_jstree(obj) {
    $('#' + obj).jstree({
        "core": {
            "themes": {
                "responsive": false
            }
        },
        "types": {
            "default": {
                "icon": "fa fa-folder text-warning"
            },
            "file": {
                "icon": "fa fa-file  text-warning"
            }
        },
        "plugins": ["types"]
    });

    // handle link clicks in tree nodes(support target="_blank" as well)
    $('#' + obj).on('select_node.jstree', function (e, data) {
        var link = $('#' + data.selected).find('a');
        if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
            if (link.attr("target") == "_blank") {
                link.attr("href").target = "_blank";
            }
            document.location.href = link.attr("href");
            return false;
        }
    });
}

function obj_select(obj) {
    $('#' + obj).select2({
        placeholder: "Choose Data",
        language: {
            // You can find all of the options in the language files provided in the
            // build. They all must be functions that return the string that should be
            // displayed.
            "noResults": function () {
                return "Data Not Found";
            },
            "inputTooShort": function () {
                return "You Should Enter At Least 1 Character";
            }
        },
        width: '100%',
    });
}

function obj_select_multiple(obj) {
    $('#' + obj).select2({
        placeholder: "Choose Data",
        language: {
            // You can find all of the options in the language files provided in the
            // build. They all must be functions that return the string that should be
            // displayed.
            "noResults": function () {
                return "Data Not Found";
            },
            "inputTooShort": function () {
                return "You Should Enter At Least 1 Character";
            }
        },
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']
    });
}

function obj_select_ajax(obj, title, url) {
    $('#' + obj).select2({
        placeholder: title,
        width: '90%',
        language: {
            // You can find all of the options in the language files provided in the
            // build. They all must be functions that return the string that should be
            // displayed.
            "noResults": function () {
                return "Data Tidak ditemukan";
            },
            "inputTooShort": function () {
                return "Anda harus memasukkan setidaknya 1 karakter";
            }
        },
        minimumInputLength: 1,
        ajax: {
            method: 'POST',
            url: url,
            data: function (params) {
                var query = {
                    search: params.term
                }
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
}

function obj_repeater(obj) {
    $('#' + obj).repeater({
        initEmpty: false,

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
}

function obj_tagify(obj) {
    var input = document.querySelector('#' + obj);
    new Tagify(input);
}

function obj_image(obj) {
    var input = document.querySelector(obj);
    var imageInput = KTImageInput.getInstance(input);
}
function obj_dropzone(obj,route, amount){
    var uploadedDocumentMap = {}
    var myDropzone = new Dropzone("#"+obj, {
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route, // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: amount,
        maxFilesize: amount, // MB
        addRemoveLinks: true,
        success: function(file, response) {
            $('form').append('<input type="hidden" name="'+obj+'[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name;
            success_toastr('File Uploaded');
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="' + obj + '[]"][value="' + name + '"]').remove()
        },
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                error_toastr("Maksimal File Upload " + amount + " File");
            });
        }
    });
}
function obj_dropzone_files(obj,route, amount){
    var uploadedDocumentMap = {}
    var myDropzone = new Dropzone("#"+obj, {
        acceptedFiles: ".pdf,.docx,.pptx",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route, // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: amount,
        maxFilesize: amount, // MB
        addRemoveLinks: true,
        success: function(file, response) {
            $('form').append('<input type="file" class="d-none" name="'+obj+'"  value="' + file + '">')
            uploadedDocumentMap[file.name] = response.name;
            success_toastr('File Uploaded');
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="' + obj + '"][value="' + name + '"]').remove()
        },
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                error_toastr("Maksimal File Upload " + amount + " File");
            });
        }
    });
}

function obj_draggable(zone, handler, form) {
    "use strict";

    // Class definition
    var KTDraggableCards = function() {
        // Private functions
        var exampleCards = function() {
            var containers = document.querySelectorAll('.'+zone);

            if (containers.length === 0) {
                return false;
            }

            var swappable = new Sortable.default(containers, {
                draggable: '.draggable',
                handle: '.draggable .'+handler,
                mirror: {
                    //appendTo: selector,
                    appendTo: 'body',
                    constrainDimensions: true
                }
            });
            swappable.on('drag:stop', (e) => {
                // remove all draggable occupied limit
                containers.forEach(c => {
                    c.classList.remove('draggable-dropzone--occupied');
                });
                var itemEl = e.data.source;  // the dragged item
                var page_id = itemEl.dataset.page_id;  // the ID of the dragged item
                var item_id = itemEl.dataset.id;  // the ID of the dragged item
                var new_order = Array.from(itemEl.parentNode.children).indexOf(itemEl);  // the new order of the item in the list (0-based)

                // Send an AJAX request to update the item's order in the database
                handle_post_reorderby(form,page_id, item_id, new_order);
            });
        }

        return {
            // Public Functions
            init: function() {
                exampleCards();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDraggableCards.init();
    });
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
// MESSAGES
var target = document.querySelector("#kt_app_body");
var block_content = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>',
});

function loading() {
    block_content.block();
}

function loaded() {
    block_content.release();
}

var target_modal = document.querySelector("#customModal");
var block_modal = new KTBlockUI(target_modal, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Harap Tunggu...</div>',
});
function loading_modal() {
    block_modal.block();
}

function loaded_modal() {
    block_modal.release();
}
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function success_toastr(pesan) {
    toastr.success(pesan, "Yada Ekidanta");
}

function error_toastr(pesan) {
    toastr.error(pesan, "Yada Ekidanta");
}
function custom_message(type, msg) {
    Swal.fire({
        showClass: {
            popup: 'animate__animated animate__fadeInDownBig'
        },
        hideClass: {
            popup: 'animate__animated animate__hinge'
        },
        position: 'top-end',
        icon: type,
        title: msg,
        showConfirmButton: false,
        timer: 2000
    });
}
function toastify_message(text)
{
    Toastify({
        text: text,
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "left", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
    }).showToast();
}
function swa_message(type, msg) {
    Swal.fire({
        showClass: {
            popup: 'animate__animated animate__fadeInDownBig'
        },
        hideClass: {
            popup: 'animate__animated animate__hinge'
        },
        position: 'top-end',
        icon: type,
        title: msg,
        showConfirmButton: false,
        timer: 2000
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function get_contact(client_id, contact_id) {
    $("#" + client_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/crm/get-contact/" + $(this).val(),
            success: function(response) {
                $("#" + contact_id).html(response);
                $("#" + contact_id).prepend("<option disabled selected>Select Client Contact</option>");
            }
        });
    });
}

function get_contact_data(client_id, contact_id, client_id_data, contact_id_data) {
    $('#' + client_id).val(client_id_data);
    setTimeout(function() {
        $('#' + client_id).trigger('change');
        setTimeout(function() {
            $('#' + contact_id).val(contact_id_data);
        }, 1200);
    }, 500);
}

function get_province(country_id, province_id) {
    $("#" + country_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/get-province/" + $(this).val(),
            success: function(response) {
                $("#" + province_id).removeAttr('disabled');
                $("#" + province_id).html(response);
                $("#" + province_id).prepend("<option disabled selected>Select Province</option>");
            }
        });
    });
}

function get_regency(province_id, regency_id) {
    $("#" + province_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/get-regency/" + $(this).val(),
            success: function(response) {
                $("#" + regency_id).removeAttr('disabled');
                $("#" + regency_id).html(response);
                $("#" + regency_id).prepend("<option disabled selected>Select Regency</option>");
            }
        });
    });
}

function get_district(regency_id, district_id) {
    $("#" + regency_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/get-district/" + $(this).val(),
            success: function(response) {
                $("#" + district_id).removeAttr('disabled');
                $("#" + district_id).html(response);
                $("#" + district_id).prepend("<option disabled selected>Select District</option>");
            }
        });
    });
}

function get_village(district_id, village_id) {
    $("#" + district_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/get-village/" + $(this).val(),
            success: function(response) {
                $("#" + village_id).removeAttr('disabled');
                $("#" + village_id).html(response);
                $("#" + village_id).prepend("<option disabled selected>Select Village</option>");
            }
        });
    });
}

function get_postcode(village_id, postcode) {
    $("#" + village_id).change(function() {
        $.ajax({
            type: "GET",
            url: "/office/get-postcode/" + $(this).val(),
            success: function(response) {
                $("#" + postcode).val(response);
            }
        });
    });
}

function get_regional_data
    (
    country_id, province_id, regency_id, district_id, village_id,
    country_id_data, province_id_data, regency_id_data, district_id_data, village_id_data
    )
{
    $('#' + country_id).val(country_id_data);
    setTimeout(function() {
        $('#' + country_id).trigger('change');
        setTimeout(function() {
            $('#' + province_id).val(province_id_data);
            $('#' + province_id).trigger('change');
            setTimeout(function() {
                $('#' + regency_id).val(regency_id_data);
                $('#' + regency_id).trigger('change');
                setTimeout(function() {
                    $('#' + district_id).val(district_id_data);
                    $('#' + district_id).trigger('change');
                    setTimeout(function() {
                        $('#' + village_id).val(village_id_data );
                        $('#' + village_id).trigger('change');
                    }, 1200);
                }, 1200);
            }, 1200);
        }, 1200);
    }, 500);
}

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
