
$(document).ready(function () {

//installment payment
    $('#paid_installment').click(function (event) {
        event.preventDefault();

        //get variable to values        
        var actual_due = $("#actual-due").val();
        var amount = $("#paid_amount").val();
        var od_limite = $("#od_limite").val();
 

        //Check amount is empty
        if (!amount) {
            swal({
                title: "Error!",
                text: "Please enter the amount ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else if (parseFloat(amount) < parseFloat(od_limite)) {
            swal({
                title: "Error!",
                text: "Amount is less than Od limite, You cannot Paid..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else if (parseFloat(actual_due) + parseFloat(od_limite) <= parseFloat(amount)) {
            var $excess = (parseFloat(actual_due) + parseFloat(od_limite)) - parseFloat(amount);

            swal({
                html: true,
                title: "Completed !",
                text: "This loan has been Completed , With excess amount" + ' <b style="color:red"> Excess ' + Math.round($excess) + ' </b>',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef2e18",
                confirmButtonText: "Yes, Paid It!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                var formData = new FormData($("form#form-data")[0]);
                $.ajax({
                    url: "post-and-get/ajax/completed-loan.php",
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {

                        if (result.status === 'error') {
                            alert('Error');
                        } else {
                            window.location = 'manage-active-loans.php';
                        }
                    }
                });
            });
        } else if (parseFloat(actual_due + parseFloat(od_limite)) >= parseFloat(amount)) {
            swal({
                title: "Paid Now!",
                text: "Do you really want to Paid this amount?...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff9600",
                confirmButtonText: "Yes, Paid It!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                var formData = new FormData($("form#form-data")[0]);
                $.ajax({
                    url: "post-and-get/ajax/installment.php",
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {

                        if (result.status === 'error') {
                            alert('Error');
                        } else {
                            window.location = 'manage-active-loans.php';
                        }
                    }
                });
            });
        }
        return false;
    });

//get od amount, Due amount, all amount in select paid date
    $('#paid_date').change(function () {
        var paid_date = $('#paid_date').val();
        var loan_id = $('#loan_id').val();

        $.ajax({
            url: "post-and-get/ajax/od-limite.php",
            type: "POST",
            data: {
                paid_date: paid_date,
                loan_id: loan_id,
                action: 'CHECKOD'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                $('#od_limite').val(jsonStr.od_amount);
                $('#due_and_excess').val(jsonStr.due_and_excess);
                $('#paid_amount').val(jsonStr.all_amount);
            }
        });
    });
}); 