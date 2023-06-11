$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
    }
});

function filterTeachingMentoring(category, dosen_id) {
    $.ajax({
        url: "/teaching-mentoring-filter",
        method: 'GET',
        data: {
            category: category,
            dosen_id: dosen_id
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#card-teaching-mentoring .card').remove();
                response.data.forEach(function(item, index) {
                    var cardHtml = '<div class="card rounded-6 my-shadow border-0 mt-3 ' + (index === response.data.length - 1 ? 'mb-3' : '') + '">' +
                        '<div class="card-body">' +
                        '<span class="text-uppercase fw-light" style="font-size: 12px">' + item.category + '</span>' +
                        '<div class="fw-semibold" style="font-size: 17px; text-transform: capitalize">' + item.title + '</div>' +
                        '<div class="text-muted">' + (item.student_name ? 'Mahasiswa: ' + item.student_name : '') + '</div>' +
                        '<div class="text-muted mt-1 fw-light">' + item.year + '</div>' +
                        '</div>' +
                        '</div>';

                    $('#card-teaching-mentoring').append(cardHtml);
                });
            } else {
                var message = '<span class="text-muted fw-light">Belum ada pengajaran dan pembimbingan yang ditambahkan</span>';
                $('#card-teaching-mentoring').append(message);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
