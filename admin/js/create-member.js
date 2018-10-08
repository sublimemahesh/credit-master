
jQuery(document).ready(function () {
    
    $("#btnSubmit").click(function (e) {
        tinymce.triggerSave();
        $('#message').hide();
        var formData = new FormData($('#member-data')[0]);
        $.ajax({
            url: "post-and-get/ajax/create-member.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (result) {
                $('#message').text("");
                if (result.status === 'error') {
                    $('#message').text(result.message);
                    $('#message').show();
                    return false;
                } else if (result.status === 'success') {
                    window.location.replace("create-member.php");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});






