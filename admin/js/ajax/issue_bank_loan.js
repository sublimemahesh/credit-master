$(document).ready(function () {

    $('#issue_bank_loan').click(function (event) {
        event.preventDefault();

        if (!$('#bank').val() || $('#bank').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer bank name..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else if (!$('#branch').val() || $('#branch').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer branch ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#branch_code').val() || $('#branch_code').val().length === 0) {
           
            swal({
                title: "Error!",
                text: "Please enter the customer branch code ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#account_number').val() || $('#account_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer account number ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#holder_name').val() || $('#holder_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer holder name ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#transaction_document').val() || $('#transaction_document').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the Transaction document ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            
            var issued_date = $('#issued_date').val();
            
            var issue_mode = $('#issue_mode').val();
            var effective_date = $('#effective_date').val();
            var result = validateForIssue(effective_date, issued_date, issue_mode);
            
        } else if (result) {


            var formData = new FormData($("form#form-data")[0]);

            $.ajax({
                url: "post-and-get/ajax/issue_bank_loan.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (jsonStr) {
                    if (jsonStr.status == 'released') {
                        window.location = 'manage-approved-loans.php';
                    } else {
                        alert('Error');
                    }
                }
            });
        }
        return false;
    });
});
