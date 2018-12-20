$(document).ready(function () {

//registration_type
    $('#registration_type').change(function () {

        var type = $(this).val();
        if (!type) {
            $('#route_row').hide();
            $('#center_row').hide();
            $('#customer').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
            $('#guarantor_1').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
            $('#guarantor_2').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
            $('#guarantor_3').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
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
                    $('#guarantor_3').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');

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
                    $('#guarantor_3').empty().append('<option value=""> -- Please Select Registration Type First--  </option>');
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
                $('#guarantor_3').empty();
                $('#guarantor_3').append(html);
                $('#guarantor_1_id').val(jsonStr.leader);
                $("#guarantor_1 option[id='cu_" + jsonStr.leader + "']").attr("selected", "selected");
                $("#guarantor_2 option[id='cu_" + jsonStr.leader + "']").remove();
                $("#guarantor_3 option[id='cu_" + jsonStr.leader + "']").remove();
            }
        });
    });

    $('#customer').change(function () {
        var credit_limit = $('option:selected', this).attr('credit_limit');
        $('#loan_amount').val(credit_limit);
        $("#loan_amount").attr("max", credit_limit);

        var customer = $(this).val();


        $('select#guarantor_2').find('option').each(function () {
            if ($(this).val() === customer) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });


        $('select#guarantor_3').find('option').each(function () {
            if ($(this).val() === customer) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });



    });

    $('.loan_amount, .interest_rate, .loan_period, .installment_type').bind("keyup change", function () {

//Variables to assign  values 
        var period = Number($('#loan_period').val());
        var installmentType = Number($('#installment_type').val());
        var numVal = Number($('#loan_amount').val());
        var numVa2 = Number($('#interest_rate').val()) / 100;
        var month = (period / 30);


        //cal Total value in month
        var totalValue = numVal + (month * (numVal * numVa2));

        //echo Total
        $('#total').val(totalValue.toFixed(2));

        //cal installment type 
        var installmentAmount = (totalValue / installmentType);

        //echo  installment type 
        var installment_price = installmentAmount / month;

        var number_of_installments = installmentType * (period / 30);

        if (number_of_installments == 12) {
            var week_of_installment_type = number_of_installments + 1;
            $('#number_of_installments').val(week_of_installment_type.toFixed(0));
            installment_price = (installment_price * 12) / 13;
            $('#installment_price').val(installment_price.toFixed(2));
        } else {
            $('#number_of_installments').val(number_of_installments.toFixed(0));
            $('#installment_price').val(installment_price.toFixed(2));
        }
    });
//loan type
    $('#verify').click(function () {
        var loan_id = $('#loan_id').val();
        var verify_by = $('#verify_by').val();
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
                    verify_by: verify_by,
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
        var approved_by = $('#approved_by').val();
        var effective_date = $('#effective_date').val();
        var issue_mode = $('#issue_mode').val();
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
                    issue_mode: issue_mode,
                    approved_by: approved_by,
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
        var issue_by = $('#issue_by').val();
        var issued_date = $('#issued_date').val();
        var issue_mode = $('#issue_mode').val();
        var issue_note = $('#issue_note').val();
        var effective_date = $('#effective_date').val();
        var loan_processing_pre_amount = $('#loan_processing_pre_amount').val();

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
                        issue_by: issue_by,
                        issued_date: issued_date,
                        issue_mode: issue_mode,
                        issue_note: issue_note,
                        loan_processing_pre_amount: loan_processing_pre_amount,
                        effective_date: effective_date,
                        action: 'ISSUE'
                    },
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr.status == 'issued') {
                            window.location = 'add-collector-payment-detail.php';
                        } else {
                            alert('Error');
                        }

                    }
                });
            });
        }
    });




///remove Loan Period in select  installment type
    $('#installment_type').change(function () {
        var installment_type = $('#installment_type').val();

        if (installment_type == 1) {
            $('#period_100').hide();

        } else if (installment_type == 4) {
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


$(document).ready(function () {

// check customer has active loan
    $('#customer').change(function () {
        var customer = $(this).val();

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                customer: customer,
                action: 'CHECK_CUSTOMER_HAS_ACTIVE_LOAN'
            },

            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "This Customer has an active loan already!...",
                        text: "Please complete it before going to new loan..",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    });
                }
            }

        });
    });


    // Check guarantor 2
    $('#guarantor_2').change(function () {
        var guarantor_2 = $(this).val();
        $('select#guarantor_3').find('option').each(function () {
            if ($(this).val() === guarantor_2) {
                $("#guarantor_3 option[id='cu_" + $(this).val() + "']").hide();
                $("#guarantor_3 option[id='cu_" + $('#customer').val() + "']").hide();
            } else {
                $("#guarantor_3 option[id='cu_" + $(this).val() + "']").hide().show();
                $("#guarantor_3 option[id='cu_" + $('#customer').val() + "']").hide();
            }
        });

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                guarantor_2: guarantor_2,
                action: 'CHECKGUARANTER_2'
            },

            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "You can not enter this Guarantor .!",
                        text: "You entered this Guarantor in two loans..",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    });
                }
            }

        });


    });

// Check guarantor 3

    $('#guarantor_3').change(function () {
        var guarantor_3 = $(this).val();

        $('select#guarantor_2').find('option').each(function () {
            if ($(this).val() === guarantor_3) {
                $("#guarantor_2 option[id='cu_" + $(this).val() + "']").hide();
                $("#guarantor_2 option[id='cu_" + $('#customer').val() + "']").hide();
            } else {
                $("#guarantor_2 option[id='cu_" + $(this).val() + "']").show();
                $("#guarantor_2 option[id='cu_" + $('#customer').val() + "']").hide();
            }
        });

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                guarantor_3: guarantor_3,
                action: 'CHECKGUARANTER_3'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "You can not enter this Guarantor .!",
                        text: "You entered this Guarantor in two loans..",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Enter Again.!",
                        closeOnConfirm: false
                    });
                }
            }
        });

    });


    //check loan processing free

    $(`#issue_mode`).change(function () {

        var issue_mode = $(this).val();
        var loan_amount = $(`#loan_amount`).val();

        if (issue_mode == 'cash') {



            $(`#document_free`).show();
            $(`#stamp_fee_amount`).show();
            $(`#loan_processing_pre`).show();
            $('#cheque_free').hide();

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    issue_mode: issue_mode,
                    loan_amount: loan_amount,
                    action: `lOANPROCESSINGPRE`

                },
                dataType: "JSON",
                success: function (jsonStr) {
                    $('#document_free_amount').val(jsonStr.result['document_free']);
                    $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                    $('#loan_processing_pre_amount').val(jsonStr.result['total']);
                }
            });

        } else if (issue_mode == 'bank') {

            $(`#document_free`).show();
            $(`#stamp_fee_amount`).show();
            $(`#loan_processing_pre`).show();
            $('#cheque_free').hide();


            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    issue_mode: issue_mode,
                    loan_amount: loan_amount,
                    action: `lOANPROCESSINGPRE`

                },
                dataType: "JSON",
                success: function (jsonStr) {
                    $('#document_free_amount').val(jsonStr.result['document_free']);
                    $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                    $('#loan_processing_pre_amount').val(jsonStr.result['total']);
                }
            });

        } else if (issue_mode == 'cheque') {
            $(`#document_free`).show();
            $(`#stamp_fee_amount`).show();
            $(`#loan_processing_pre`).show();
            $(`#cheque_free`).show();

            $.ajax({
                url: "post-and-get/ajax/loan.php",
                type: "POST",
                data: {
                    issue_mode: issue_mode,
                    loan_amount: loan_amount,
                    action: `lOANPROCESSINGPRE`

                },
                dataType: "JSON",
                success: function (jsonStr) {
                    $('#document_free_amount').val(jsonStr.result['document_free']);
                    $('#cheque_free_amount').val(jsonStr.result['cheque_free']);

                    $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                    $('#loan_processing_pre_amount').val(jsonStr.result['total']);
                }
            });
        } else {
            $(`#document_free`).hide();
            $(`#stamp_fee_amount`).hide();
            $(`#loan_processing_pre`).hide();
            $(`#cheque_free`).hide();
        }
    });


    ///Before delete Check Customer '
    $('.delete-customer').click(function () {
        var customer = $(this).attr("data-id");

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                customer: customer,
                action: 'CHECKCUSTOMERHASLOAN'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "This Customer Can Not Be Deleted ..!",
                        text: "The customer already exists in a loan",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#00b0e4",
                        confirmButtonText: "Ok.!",
                        closeOnConfirm: false
                    });
                }
            }
        });
    });

});


window.onload = function () {

    //get other page to issumode prices in onloard

    var issue_mode = document.getElementById("issue_mode_onloard").value;
    var loan_amount = document.getElementById("loan_amount").value;


    if (issue_mode == 'bank') {

        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                issue_mode: issue_mode,
                loan_amount: loan_amount,
                action: `lOANPROCESSINGPRE`

            },
            dataType: "JSON",
            success: function (jsonStr) {
                $('#document_free_amount').val(jsonStr.result['document_free']);
                $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
            }
        });
    } else if (issue_mode == 'cash') {
        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                issue_mode: issue_mode,
                loan_amount: loan_amount,
                action: `lOANPROCESSINGPRE`

            },
            dataType: "JSON",
            success: function (jsonStr) {
                $('#document_free_amount').val(jsonStr.result['document_free']);
                $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
            }
        });
    } else if (issue_mode == 'cheque') {
        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $(`#cheque_free`).show();
        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                issue_mode: issue_mode,
                loan_amount: loan_amount,
                action: `lOANPROCESSINGPRE`

            },
            dataType: "JSON",
            success: function (jsonStr) {
                $('#document_free_amount').val(jsonStr.result['document_free']);
                $('#cheque_free_amount').val(jsonStr.result['cheque_free']);
                $('#stamp_fee').val(jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
            }
        });
    }

    //get other page to issumode prices in onloard
    var interest_rate = document.getElementById("interest_rate_onloard").value;
    var period = document.getElementById("loan_period").value;
    var numVal = document.getElementById("loan_amount").value;
    var numVa2 = Number(interest_rate) / 100;

    var month = (period / 30);
    //cal Total value in month
    var totalValue = (month * (numVal * numVa2));
    document.getElementById("total").value = totalValue;
}; 