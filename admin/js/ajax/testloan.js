    
///-----------Windows Onloard----------// 
window.onload = function () {

    //get other page to issumode prices in onloard
    var issue_mode = $('#issue_mode_onloard').val();
    var loan_amount = $('#loan_amount').val();



    if (issue_mode == 'bank') {

        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $(`#bank_transaction_free_amount`).show();
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
                $('#document_free_amount').val('Doc Fee: ' + jsonStr.result['document_free']);
                $('#stamp_fee').val('Stamp Fee: ' + jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
                $('#bank_transaction_free').val('Bank Fee: ' + jsonStr.result['bank_transaction_free']);
            }
        });

    } else if (issue_mode == 'cash') {

        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $(`#bank_transaction_free_amount`).hide();
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
                $('#document_free_amount').val('Doc Fee: ' + jsonStr.result['document_free']);
                $('#stamp_fee').val('Stamp Fee: ' + jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
            }
        });

    } else if (issue_mode == 'cheque') {

        $(`#document_free`).show();
        $(`#stamp_fee_amount`).show();
        $(`#loan_processing_pre`).show();
        $(`#cheque_free`).show();
        $(`#bank_transaction_free_amount`).hide();

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
                $('#document_free_amount').val('Doc Fee: ' + jsonStr.result['document_free']);
                $('#cheque_free_amount').val('Cheque Fee: ' + jsonStr.result['cheque_fee']);
                $('#stamp_fee').val('Stamp Fee: ' + jsonStr.result['stamp_fee']);
                $('#loan_processing_pre_amount').val(jsonStr.result['total']);
            }
        });
    }


//get last loan amount by customer
    var customer_id = $('#customer_id').val();
    var loan_amount = $('#loan_amount').val();
    var issue_mode = $('#issue_mode_onloard').val();
    var loan_id = $('#loan_id').val();

    $.ajax({
        url: "post-and-get/ajax/loan.php",
        type: "POST",
        data: {
            issue_mode: issue_mode,
            customer_id: customer_id,
            loan_amount: loan_amount,
            loan_id: loan_id,
            action: `LASTLOANAMOUNTBYCUSTOMER`
        },
        dataType: "JSON",
        success: function (jsonStr) {

            if (jsonStr.balance_of_last_loan != 0) {
                $('#blanace__amount').append("<div class='alert alert-danger'> <strong>This Customer has last loan Balance.. Please Check it..!</strong></div>");
                $('#balance_of_last_loan').val(jsonStr.balance_of_last_loan);
                $('#total_deductions').val(jsonStr.total_deductions);
                $('#balance_pay').val(jsonStr.balance_pay);
                $('#paid_loan_processing_fee').val(jsonStr.paid_loan_processing_fee);
                $('#down_payment').val(jsonStr.down_payment);
                $('#paid_loan_processing_fee').val(jsonStr.paid_loan_processing_fee);

                //show all
                $('#down_payment_row').show();
                $('#balance_of_last_loan_row').show();
                $('#paid_loan_processing_fee_row').show();
            } else {
                $('#balance_of_last_loan').val(jsonStr.balance_of_last_loan);
                $('#total_deductions').val(jsonStr.total_deductions);
                $('#balance_pay').val(jsonStr.balance_pay);
            }
        }
    });


//view loan amount interest and loan amount

    var loan_amount = $('#loan_amount').val();
    var interest_rate = $('#interest_rate').val();
    var number_of_installments = $('#number_of_installments').val();
    var paid_number_installment = $('#paid_number_installment').val();
    var paids_amount = $('#paids_amount').val();

    //cal

    var amount = (loan_amount * interest_rate) / 100;
    var interest_amount = ((amount / number_of_installments) * paid_number_installment).toFixed(2);
    var due_amount = (paids_amount - interest_amount).toFixed(2)

    $('#interest_amount').val(interest_amount);
    $('#due_amount').val(due_amount);

// cal net amount in onloard

    var period = $('#loan_period').val();
    var numVal = $('#loan_amount').val();
    var interest_rate = $('#interest_rate').val();

    var numVa2 = Number(interest_rate) / 100;

    var month = (period / 30);
    //cal Total value in month
    var totalValue = parseFloat(numVal) + parseFloat((month * (numVal * numVa2)));
    $('#total').val(totalValue);
};
