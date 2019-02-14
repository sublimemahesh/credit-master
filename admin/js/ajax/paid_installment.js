$(document).ready(function () {

    $('#paid_installment').click(function (event) {
        event.preventDefault();

        var actual_due = $("#actual-due").val();
        var amount = $("#paid_amount").val();

        if (actual_due < amount) {

            var due_amount = amount - actual_due;

            swal({
                title: "Completed!",
                text: "Do you really want to reject this loan?...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff9600",
                confirmButtonText: "Yes, Reject It!",
                closeOnConfirm: false
            });
        } else {
            swal({
                title: "Reject!",
                text: "Do you really want to reject this loan?...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff9600",
                confirmButtonText: "Yes, Reject It!",
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
                            function () {

                            }
                            
                        }
                    }

                });

                return false;
            });
        }
    });
});

