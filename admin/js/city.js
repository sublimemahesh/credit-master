
$(document).ready(function () {
    $('#district').change(function () {

        var disID = $(this).val();
   
        $.ajax({
            url: "post-and-get/ajax/city.php",
            type: "POST",
            data: {
                district: disID,
                action: 'GETCITYSBYDISTRICT'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option> -- Please Select a City -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#city-bar').empty();
                $('#city-bar').append(html);
            }
        });
    });
});

