$(document).ready(function() {
    var table =  $('#carInventoryTbl').DataTable( {
        "processing": true,
        "serverSide": true,
        "select": true,
        pageLength: 50,
        "ajax": {
            "url": "/admin/reservations/all",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        "order": [[1, 'desc']],
        "columns": [
            {
                "className":      'details-control',
                orderable:      false,
                data:           null,
                name: "Serial",
                defaultContent: ''
            },
            {
                data: "users.name",
                name:"Client Name",
                render: function ( data, type, full, meta ) {
                    return full.user.name;
                }
            },
            {
                data: "car_models.make",
                name:"Car",
                render: function ( data, type, full, meta ) {
                    return full.details[0].model.make+' '+full.details[0].model.model;
                }
            },
            {
                data: "rental_cars.registration_number",
                name:"Registration No",
                render: function ( data, type, full, meta ) {
                    return full.details[0].car.registration_number;
                }
            },
            {
                orderable:      false,
                data:           null,
                name:"Car Type",
                render: function ( data, type, full, meta ) {
                    return full.details[0].car_type.vehicle_size.code_letter
                        +''+full.details[0].car_type.vehicle_doors.code_letter
                        +''+full.details[0].car_type.vehicle_transmission_and_drive.code_letter
                        +''+full.details[0].car_type.vehicle_fuel_and_a_c.code_letter;
                }
            }, 
            {
                data: "rental_car_reservations.status",
                name:"Status",
                render: function ( data, type, full, meta ) {
                    return '<a title="Update Reservation Status" href="#" data-id="' + full.id + '"  class="editor_edit">'+full.status.toUpperCase()+'</a>';
                }  
            },
            {
                data: "car_reservation_details.total_price",
                name:"Total",
                render: function ( data, type, full, meta ) {
                    return full.details[0].total_price;
                }
            },

            {
                data: "links",
                name:'Actions',
                orderable: false,
                searchable: false,
                render: function ( data, type, full, meta ) {

                    var line1 = '<div class="dropdown"><a data-target="#actions-' + full.id + '" href="#actions-' + full.id + '" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More<span class="caret"></span></a>';
                    var line2 = '<ul class="dropdown-menu list-group" aria-labelledby="#actions-' + full.id + '">';
                    var edit_link = '<li><a data-id="' + full.id + '" href="/admin/reservations/' + full.id+ '/edit" class="order_edit"><span class="text-success"><i class="fa fa-pencil-square-o"></i> Edit</span></a></li>';
                    var invoice_link = '<li><a data-id="' + full.id + '" href="/admin/reservations/' + full.id+ '/invoice" class="order_invoice"><span class="text-info"><i class="fa fa-usd"></i> Invoice</span></a></li>';

                    var delete_link = '<li><a data-id="' + full.id + '" href="/admin/reservations/' + full.id+ '/delete" class="order_delete"><span class="text-danger"><i class="fa fa-trash-o"></i> Delete</span></a></li>';
                    var line3 = '</ul></div>';

                    return line1 + line2 + edit_link + invoice_link + delete_link + line3;
                }
            }

        ],
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
            $("td:first", nRow).html(iDisplayIndex +1);
            return nRow;
        },
    });

    // Edit record
    table.on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
        processing();
        
        formData =  {'_method' : 'POST', 'id': $(this).data('id')};
        $.ajax({
            url: '/admin/reservations/info',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData
        })
        .done(function(response){
            $('form#editReservation input#id').val(response.data.id)
            $('form#editReservation select#status').val(response.data.status)
            $.unblockUI();
            $('#editReservation').modal({show: true, backdrop: 'static',keyboard: false});
        })
        .fail(function(response){
            $.unblockUI();
            $.each(response.responseJSON, function (key, value) {
                $.each(value, function (index, message) {
                    displayMessageAlert(message, 'danger', 'warning-sign');
                });
            });
        });
    });
    
    $(".modal").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });
    
    $(document).on("click", "button.btn-editreservation", function(e) {
        processing();
        var formData = $('form#editReservation').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post($('form#editReservation').attr('action'), formData)
        .done(function(response){
            $.unblockUI();
            displayMessageAlert(response.message);
            $('#editReservation').modal('hide');
            table.ajax.reload();
        })
        .fail(function(response){
            $('#discount_code').val('');
            $.unblockUI();
            $.each(response.responseJSON, function (key, value) {
                $.each(value, function (index, message) {
                    displayMessageAlert(message, 'danger', 'warning-sign');
                });
            });
        });
    });
    
} );