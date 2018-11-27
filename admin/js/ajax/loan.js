
$(document).ready(function () {

    $('#registration_type').change(function () {

        var type = $(this).val();
        if (!type) {
            $('#route_row').hide();
            $('#center_row').hide();
            $('#customer').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
            $('#guarantor_1').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
            $('#guarantor_2').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');

        }

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETREGTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.type == 'route') {
                    var html = '<option value=""> -- Please Select a Route -- </option>';
                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#route').empty();
                    $('#route').append(html);
                    $('#route_row').show();
                    $('#center_row').hide();
                    $('#customer').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
                    $('#guarantor_1').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
                    $('#guarantor_2').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');

                } else if (jsonStr.type == 'center') {
                    var html = '<option value=""> -- Please Select a Center -- </option>';
                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#center').empty();
                    $('#center').append(html);
                    $('#center_row').show();
                    $('#route_row').hide();
                    $('#customer').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
                    $('#guarantor_1').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
                    $('#guarantor_2').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
                }
            }
        });
    });

    $('.customer-ref').change(function () {

        var type = this.id;
        var value = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                type: type,
                value: value,
                action: 'GETCUSTOMER'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option value=""> -- Please Select a Customer -- </option>';
                $.each(jsonStr.data, function (i, data) {
                    html += '<option value="' + data.id + '"  id="cu_' + data.id + '" credit_limit="' + data.credit_limit + '">';
                    html += data.title + ' ' + data.first_name + ' ' + data.last_name;
                    html += '</option>';
                });
                $('#customer').empty();
                $('#customer').append(html);
                $('#guarantor_1').empty();
                $('#guarantor_1').append(html);
                $('#guarantor_2').empty();
                $('#guarantor_2').append(html);
                $("#guarantor_1 option[id='cu_" + jsonStr.leader + "']").attr("selected", "selected");

            }
        });
    });


    $('#customer').change(function () {
        var credit_limit = $('option:selected', this).attr('credit_limit');
        $('#loan_amount').val(credit_limit);
        $("#loan_amount").attr("max", credit_limit);
    });




    $('.loan_amount, .interest_rate, .loan_period, .installment_type').bind("keyup change", function () {

//Variables to assign  values 
        var period = Number($('#loan_period').val());
        var installmentType = Number($('#installment_type').val());
        var numVal = Number($('#loan_amount').val());
        var numVa2 = Number($('#interest_rate').val()) / 100;
        var Month = (period / 30);



        //cal Total value in month
        var totalValue = numVal + (Month * (numVal * numVa2));

        //echo Total
        $('#total').val(totalValue.toFixed(2));

        //cal installment type
        var installmentAmount = (totalValue / installmentType);

        //echo  installment type

        var installment_price = installmentAmount / Month;
        var number_of_installments = installmentType * (period / 30);

        $('#number_of_installments').val(number_of_installments.toFixed(0))
        $('#installment_price').val(installment_price.toFixed(2));
    });

    $('#verify').click(function () {
        var loan_id = $('#loan_id').val();
        var effective_date = $('#effective_date').val();
        var comments = $('#comments').val();

        swal({
            title: "Verify!",
            text: "Do you really want to verify this loan?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#2b982b",
            confirmButtonText: "Yes, Verify It!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    effective_date: effective_date,
                    verify_comments: comments,
                    action: 'VERIFY'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'verified') {
                        window.location = 'manage-pending-loans.php';
                    } else {
                        alert('Error');
                    }

                }
            });
        });

    });

    $('#reject').click(function () {
        var loan_id = $('#loan_id').val();

        swal({
            title: "Reject!",
            text: "Do you really want to reject this loan?...",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff9600",
            confirmButtonText: "Yes, Reject It!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    action: 'REJECT'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'rejected') {
                        window.location = 'manage-pending-loans.php';
                    } else {
                        alert('Error');
                    }

                }
            });
        });

    });

    $('#delete').click(function () {
        var loan_id = $('#loan_id').val();

        swal({
            title: "Delete!",
            text: "Do you really want to Delete this loan?...",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#fb483a",
            confirmButtonText: "Yes, Delete It!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    action: 'DELETE'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'deleted') {
                        window.location = 'manage-pending-loans.php';
                    } else {
                        alert('Error');
                    }

                }
            });
        });

    });

    $('#approve').click(function () {

        var loan_id = $('#loan_id').val();
        var effective_date = $('#effective_date').val();
        var comments = $('#comments').val();

        swal({
            title: "Approve!",
            text: "Do you really want to approve this loan?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#2b982b",
            confirmButtonText: "Yes, Approve It!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    effective_date: effective_date,
                    verify_comments: comments,
                    action: 'APPROVE'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'approve') {
                        window.location = 'manage-verified-loans.php';
                    } else {
                        alert('Error');
                    }

                }
            });
        });
    });

    $('#pending').click(function () {

        var loan_id = $('#loan_id').val();
        var effective_date = $('#effective_date').val();
        var comments = $('#comments').val();

        swal({
            title: "Back!",
            text: "Do you really want to back this loan for pending?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#00b0e4",
            confirmButtonText: "Yes, Back It!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    effective_date: effective_date,
                    verify_comments: comments,
                    action: 'PENDING'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'pending') {
                        window.location = 'manage-verified-loans.php';
                    } else {
                        alert('Error');
                    }

                }
            });
        });
    });

    $('#issue').click(function () {

        var loan_id = $('#loan_id').val();
        var issued_date = $('#issued_date').val();
        var issue_mode = $('#issue_mode').val();
        var issue_note = $('#issue_note').val();
        var effective_date = $('#effective_date').val();

        var result = validateForIssue(effective_date, issued_date, issue_mode);

        if (result) {
            swal({
                title: "Issue!",
                text: "Do you really want to issue this loan?...",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Yes, Issue It!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/loan.php",
                    type: "POST",
                    data: {
                        loan_id: loan_id,
                        issued_date: issued_date,
                        issue_mode: issue_mode,
                        issue_note: issue_note,
                        effective_date: effective_date,
                        action: 'ISSUE'
                    },
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr.status == 'issued') {
                            window.location = 'manage-approved-loans.php';
                        } else {
                            alert('Error');
                        }

                    }
                });
            });
        }
    });

    $('#installment_type').change(function () {
        var installment_type = $('#installment_type').val();

        if (installment_type == 1) {
            $('#period_100').hide();
        } else {
            $('#period_100').show();
        }
    });

    function validateForIssue(effective_date, issued_date, issue_mode) {


        if (!Date.parse(effective_date)) {
            swal({
                title: "Error!",
                text: "Please select valid effective date.",
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "red"
            });
            return false;
        } else if (!Date.parse(issued_date)) {
            swal({
                title: "Error!",
                text: "Please select valid issued date.",
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "red"
            });
            return false;
        } else if (issue_mode.length == 0) {
            swal({
                title: "Error!",
                text: "Please select valid issue mode.",
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "red"
            });
            return false;
        } else {
            return true;
        }


    }

});