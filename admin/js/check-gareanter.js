$(document).ready(function () {
    $('#guarantor_2').change(function () {
        var guarantor_2 = $(this).val();

        $.ajax({
            url: "post-and-get/ajax/loan.php",
            type: "POST",
            data: {
                guarantor_2: guarantor_2,
                action: 'CHECKGUARANTER'
            },

            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                    swal({
                        title: "You canot Enter this Guarantor .!",
                        text: "You entered this Guarantor in two loans..",
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

});
