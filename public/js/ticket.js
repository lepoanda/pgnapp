$(function () {

    getTicketList();

    function getTicketList() {
        $.ajax({
            type: 'GET',
            url: "/ticket/get_ticket_list",
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                var row = "";
                for (var i = 0; i < data.length; i++) {
                    row += '<tr>' +
                        '<td>' + [i + 1] + '</td>' +
                        '<td name= "booking_code">' + data[i].booking_code + '</td>' +
                        '<td name="rute_awal">' + data[i].rute_awal + '</td>' +
                        '<td name="users">' + data[i].users + '</td>' +
                        '<td name="total_users">' + data[i].total_users + '</td>' +
                        '<td name="ticket_code">' + data[i].ticket_code + '</td>' +
                        '<td name="status">' + data[i].status + '</td>' +
                        '<td>' +
                        '<div class="btn-action btn-group">' +
                        '<button class="btn btn-primary btn-sm btn-details" data-type="details" data-toggle="tooltip" data-original-title="Details" data-id2="' + data[i].ticket_id + '" data-id="' + data[i].booking_code + '">Details</button>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                }
                $('#target').html(row);
            }
        });
    }


    $(this).on('click', '.btn-details', function (e) {
        var booking_code = $(this).data('id');
        var ticket_id = $(this).data('id2');
        var generateCode = makeid(7);
        var form = $('#form-details');
        $.ajax({
            type: 'GET',
            url: "/ticket/get_ticket_details",
            data: {
                booking_code: booking_code,
                ticket_id: ticket_id

            },
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                // console.log(data);
                var awal = data[0].rute_awal;
                var tujuan = data[0].rute_tujuan;
                var rute = awal + "-" + tujuan;
                form.find('input[name="genCode"]').val(generateCode);
                form.find('input[name="id_trip"]').val(data[0].trip_id);
                form.find('input[name="ticket_id"]').val(data[0].ticket_id);
                $('#rute-modal').html(rute);
                $('#username-modal').html(data[0].username);
                $("#modal-details").modal("toggle");
            }
        });
    });

    $(this).on('submit', '#form-details', function (e) {
        var form = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "/ticket/approved",
            data: form,
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                alert(data);
                getTicketList();
            }
        });

    });

    $(this).on('submit', '#form-ticket', function (e) {
        var form = $(this).serialize();
        $.ajax({
            type: 'GET',
            url: "/ticket/get_ticket",
            data: form,
            dataType: 'JSON',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                alert(data);
                location.reload();
            }
        });

    });

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
});