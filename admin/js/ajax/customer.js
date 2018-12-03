
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
    $('#edit_registration_type').change(function () {

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

    $('#bank_id').change(function () {

        var bank_id = $(this).val();
        $.ajax({

            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                bank_id: bank_id,
                action: 'GETBANKNAME'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option> -- Please Select a Branch -- </option>';
                $.each(jsonStr.data, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#branch').empty();
                $('#branch').append(html);
                $('#branch_row').show();
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
                        confirmButtonText: "Enter Again.!",
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
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    });
                }
            }
        });
    });

    $("#form").submit(function (e) {
        var errors = $('#errors').val();
        if (errors == 1) {
            e.preventDefault();
            $('#errors').val(0);
        }

        var id = $('#id').val();
        var nicNumber = $('#customer_nic_number').val();
        var mobileNumber = $('#customer_moblie_number').val();

        $.ajax({
            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                id: id,
                nicNumber: nicNumber,
                mobileNumber: mobileNumber,
                action: 'CHECKNIC&MOBILEEXISTCUSTOMER'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                if (jsonStr.status == 'nicIsExist') {
                    $('#errors').val(1);
                    swal({
                        title: "Duplicate NIC Number.!",
                        text: "You entered the duplicate NIC number..",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    }, function () {
                        swal.close();
                        $('html, body').animate({
                            scrollTop: $("#surname").offset().top
                        }, 1000);
                        $('#customer_nic_number').focus();
                    });

                } else if (jsonStr.status == 'mobileIsExist') {
                    $('#errors').val(1);
                    swal({
                        title: "Duplicate Mobile Number.!",
                        text: "You entered the duplicate mobile number..",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    }, function () {
                        swal.close();
                        $('html, body').animate({
                            scrollTop: $("#email").offset().top
                        }, 1000);
                        $('#customer_moblie_number').focus();
                    });
                } else if (jsonStr.status == 'fales') {
                    $('#errors').val(0);
                    $('#form').unbind().submit();
                }
            }
        });


    });
});





  