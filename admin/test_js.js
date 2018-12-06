

$(`#issue_mode_onloard`).onload(function () {
 

    var issue_mode = $(this).val();
    alert();
    var loan_amount = $(`#loan_amount`).val();
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
});
 