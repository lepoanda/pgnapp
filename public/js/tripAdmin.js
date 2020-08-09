$(function () {
    getTripAdmin();


    function getTripAdmin() {
        $.ajax({
            type: 'GET',
            url: "/trip/get_trip",
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {

                var row = "";
                for (var i = 0; i < data.length; i++) {
                    row += '<tr>' +
                        '<td>' + [i + 1] + '</td>' +
                        '<td>' + data[i].transport + '</td>' +
                        '<td>' + data[i].rute_awal + '</td>' +
                        '<td>' + data[i].rute_tujuan + '</td>' +
                        '<td>' + data[i].jadwal + '</td>' +
                        '<td>' +
                        '<div class="btn-action btn-group">' +
                        '<button class="btn btn-info btn-sm btn-edit" data-type="Edit" data-toggle="tooltip" data-original-title="Edit" data-id="' + data[i].trip_id + '">Edit</button>' +
                        '<button class="btn btn-danger btn-sm btn-delete" data-type="delete" data-original-title="Delete" data-id="' + data[i].trip_id + '">Delete</button>' +
                        '<button class="btn btn-primary btn-sm btn-booking" data-type="booking" data-toggle="tooltip" data-original-title="Booking" data-id="' + data[i].trip_id + '">Booking</button>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $('#target').html(row);
            }
        });
    }
    $(this).on('click', '.btn-delete', function (e) {
        var trip_id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: "/trip/delete_trip",
            data: {
                trip_id: trip_id,
            },
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                alert(data);
                getTripAdmin();
            }
        });
    });

    $(this).on('click', '.btn-booking', function (e) {
        var id = $(this).data('id');
        var user_id = $('#user_id').val();
        var form = $('#form-booked');
        $.ajax({
            type: 'GET',
            url: "/trip/get_trip_details",
            data: {
                id: id,
                user_id: user_id,
            },
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                var awal = data[0].rute_awal;
                var tujuan = data[0].rute_tujuan;
                var rute = awal + "-" + tujuan;
                form.find('input[name="id"]').val(user_id);
                form.find('input[name="id_trip"]').val(id);
                $('#rute-modal').html(rute);
                $("#modal-booking").modal("toggle");
            }
        });
    });

    $(this).on('submit', '#form-booked', function (e) {
        var form = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "/trip/booked_trip",
            data: form,
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                alert(data);

            }
        });
    });

    $(this).on('submit', '#form-add', function (e) {
        var form = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "/trip/add_trip",
            data: form,
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                alert(data);

            }
        });
    });


});