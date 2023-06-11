function initTooltips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

function handle_is_active(method, route, tombol, data) {
    var title = "";
    if (data == 1) {
        title = "Apakah Anda yakin ingin mengaktifkan data ini?";
    } else {
        title = "Apakah Anda yakin ingin menonaktifkan data ini?";
    }
    Swal.fire({
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        },
        position: 'top-end',
        title: title,
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
                data: {
                    is_active: data
                },
                dataType: 'json',
                success: function (response) {
                    loaded()
                    toast.show();
                    $(tombol).prop("disabled", false);
                    $(tombol).removeAttr("data-kt-indicator");
                    if (response.alert == "success") {
                        let message = response.message;
                        $("#toast_body").html(message);
                        setTimeout(() => {
                            swup.loadPage({
                                url: $(tombol).data('redirect-url'),
                            });
                        }, 1000);
                    } else {
                        let message = response.message;
                        $("#toast_body").html(message);
                    }
                },
                error: function (xhr) {
                    handle_error(xhr);
                },
            });
        } else if (result.isDenied) {
            $("#toast_body").html('Anda membatalkan konfirmasi');
        }
    });
}
