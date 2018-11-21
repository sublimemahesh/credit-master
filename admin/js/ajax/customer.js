
$(document).ready(function () {
    $('#registration_type').change(function () {

        var type = $(this).val();
        if (!type) {
            $('#route_row').hide();
            $('#center_row').hide();
        }

        $.ajax({
            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETREGTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.type == 'route') {
                    var html = '<option> -- Please Select a Route -- </option>';
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



    $('.check-customer').click(function () {
 
        var nicNumber = $('#customer-nic').val();
     
        $.ajax({
            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                NicNumber: nicNumber,
                action: 'CHECKNICNUMBERINCUSTOMER'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "Duplicate NIC Number.!",
                        text: "You entered the duplicate NIC Number..",
                        type: "info",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter again.!",
                        closeOnConfirm: false
                    });
                }
            }
        });
    });


    $('.check-customer').click(function () {

        var mobileNumber = $('#moblie_number').val();

        $.ajax({
            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                MobileNumber: mobileNumber,
                action: 'CHECKMOBILENUMBERINCUSTOMER'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "Duplicate Mobile Number.!",
                        text: "You entered the duplicate Mobile Number..",
                        type: "info",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter again.!",
                        closeOnConfirm: false
                    });
                }
            }
        });
    });
});




  