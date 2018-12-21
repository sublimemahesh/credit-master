 
window.onload = function () {
    
 
  
    var type = document.getElementById("registration_type").value;
    var value = document.getElementById("center").value;
    var ss = document.getElementById("ss").value;
    var ss2 = document.getElementById("ss2").value;
   
    var customer = document.getElementById("customer").value;

    $('select#guarantor-2').find('option').each(function () {
        if ($(this).val() === customer) {
            alert();
            $("#guarantor-2 option[id='cu_" + $(this).val() + "']").hide();
        }
    });

    $.ajax({
        url: "post-and-get/ajax/loan.php",
        type: "POST",
        data: {
            type: type,
            value: value,
            action: 'GETGURANTOR'
        },

        dataType: "JSON",
        success: function (jsonStr) {
            if (jsonStr.type == 'route') {
                var html = '<option value="">' + ss2 + '</option>';
                $.each(jsonStr.data, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.title + ' ' + data.first_name + ' ' + data.last_name;
                    html += '</option>';
                });
                $('#guarantor-2').empty();
                $('#guarantor-2').append(html);
                $('#guarantor-3').empty();
                $('#guarantor-3').append(html);

            } else if (jsonStr.type == 'center') {
                var html = '<option value="">' + ss + '</option>';

                $.each(jsonStr.data, function (i, data) {
                    html += '<option id="cu_' + data.id + '" value="' + data.id + '">';
                    html += data.title + ' ' + data.first_name + ' ' + data.last_name;
                    html += '</option>';
                });
                $('#guarantor-2').empty();
                $('#guarantor-2').append(html);
                $('#guarantor-3').empty();
                $('#guarantor-3').append(html);

            }
        }



    });
}; 