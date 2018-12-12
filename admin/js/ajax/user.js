jQuery(document).ready(function () {

    $("#btnSubmit").click(function (event) {
        event.preventDefault();

        if (!$('#name').val() || !$('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter Name..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#username').val() || $('#username').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter User Name..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter User Email..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter Password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#user_level').val() || $('#user_level').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter User Level..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#image_name').val() || $('#image_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter User Image..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            //grab all form data  
            var formData = new FormData($("form#user")[0]);

            $.ajax({
                url: "post-and-get/ajax/user.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {


                }
            });
        }
        return false;
    });
});


