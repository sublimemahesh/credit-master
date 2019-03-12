$(document).ready(function () {
    $('#registration_type').change(function () {

        var type = $(this).val();

        if (!type) {
            $('#route_row').hide();
            $('#center_row').hide();
        } else if (type == 0) {
            $('#route_row').hide();
            $('#center_row').hide();
        }
        $.ajax({
            url: "post-and-get/ajax/postpone-date.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETREGTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.type == 'route') {
                    var html = '<option> -- Please Select a Route -- </option>';
                    html += '<option value="all"> All</option>';

                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#route').empty();
                    $('#route').append(html);
                    $('#route_row').show();
                    $('#center_row').hide();


                } else if (jsonStr.type == 'center') {
                    var html = '<option> -- Please Select a Center -- </option>';
                    html += '<option value="all"> All</option>';
                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#center').empty();
                    $('#center').append(html);
                    $('#center_row').show();
                    $('#route_row').hide();

                }
            }
        });
    });
});

$('.customer-ref-postpone-date,#registration_type').change(function () {
    
    var type = this.id;
    var value = $(this).val();

    var registration_type_append_show = $('#registration_type').val();


    if (registration_type_append_show || registration_type_append_show === ''   ) {
        $('#customer_postpone_date_row').hide();
        $('#route_row').hide();
        $('#center_row').hide();
    }

    $.ajax({
        url: "post-and-get/ajax/postpone-date.php",
        type: "POST",
        data: {
            type: type,
            value: value,
            action: 'GETCUSTOMER'
        },
        dataType: "JSON",
        success: function (jsonStr) {
            var html = '<option value="0"> -- All Customers -- </option>';

            $.each(jsonStr.data, function (i, data) {
                html += '<option value="' + data.id + '">';
                html += data.title + ' ' + data.first_name + ' ' + data.last_name;
                html += '</option>';
            });
            $('#customer-postpone-date').empty();
            $('#customer-empty').hide();
            $('#customer_postpone_date_row').show();
            $('#customer-postpone-date').append(html);

        }
    });
}); 