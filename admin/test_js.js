


text / x - generic add - student.js (ASCII C++ program text)

        jQuery(document).ready(function () {

    $("#btnSubmit").click(function (event) {
        event.preventDefault();

        if (!$('#mis_no').val() || $('#mis_no').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter student MIS Number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#nic_number').val() || $('#nic_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter student NIC Number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter student Name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#sex').val() || $('#sex').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select student gender",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter student Address",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#contact_number').val() || $('#contact_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter student contact number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            //grab all form data  
            var formData = new FormData($("form#student-form")[0]);

            $.ajax({
                url: "post-and-get/ajax/add-student.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {

                    if (result.status === 'success') {
//                        $('#mis_no').val.emp;
                        swal({
                            title: "success!",
                            text: "Your data saved successfully !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.setTimeout(function () {
                            window.location.reload()
                        }, 2000);
                        $('#yearlist').prepend(html);

                    } else if (result.status === 'alreadyhave') {
                        swal({
                            title: "Error!",
                            text: "The student already exists !!",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (result.status === 'error') {

                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });

        }
        return false;
    });
});


