$(document).ready(function () {

    $('#paid_installment').click(function (event) {
        event.preventDefault();

        var actual_due = $("#actual-due").val();
        var amount = $("#paid_amount").val();

        if (!amount) {
            swal({
                title: "Error!",
                text: "Please enter the amount ..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (parseInt(actual_due) < parseInt(amount)) {
            $excess = parseInt(amount) - parseInt(actual_due);

            swal({
                html: true,
                title: "Completed !",
                text: "This loan has been Completed , With excess amount" + ' <b> Excess ' + $excess + ' </b>',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ef2e18",
                confirmButtonText: "Yes, Paid It!",
                closeOnConfirm: false

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
                            window.location = 'manage-released-loan.php';
                        }
                    }
                });
            });
        } else if (parseInt(actual_due) >= parseInt(amount)) {
            swal({
                title: "Paid Now!",
                text: "Do you really want to Paid this amount?...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff9600",
                confirmButtonText: "Yes, Paid It!",
                closeOnConfirm: false

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
                            window.location = 'manage-released-loan.php';
                        }
                    }

                });
            });
        }
        return false;
    });

    $('#paid_date').change(function () {

        var paid_date = $('#paid_date').val();
        var loan_id = $('#loan_id').val();

        $.ajax({
            url: "post-and-get/ajax/paid_installment.php",
            type: "POST",
            data: {
                paid_date: paid_date,
                loan_id: loan_id,

                action: 'CHECKOD'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                $('#od_limite').val(jsonStr.od_limite);
                $('#due_and_excess').val(jsonStr.due_and_excess);
                $('#all_amount').val(jsonStr.all_amount);
            }
        });
    });
});

 