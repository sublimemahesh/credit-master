
$(document).ready(function () {
    $('#registration_type').change(function () {

        var type = $(this).val();
        if (!type) {
            $('#route_row').hide();
            $('#center_row').hide();
        }
        $.ajax({
            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETREGTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.type == 'route') {
                    var html = '<option> -- Please Select a Route -- </option>';
                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#route').empty();
                    $('#route').append(html);
                    $('#route_row').show();
                    $('#center_row').hide();

                } else if (jsonStr.type == 'center') {
                    var html = '<option> -- Please Select a Center -- </option>';
                    $.each(jsonStr.data, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    $('#center').empty();
                    $('#center').append(html);
                    $('#center_row').show();
                    $('#route_row').hide();
                }

            }
        });
    });
});


///calculate the total loan 

$(document).ready(function () {
    $('.loan_amount, .interest_rate, .loan_period, .installment_type').change(function () {

        //Variables to assign  values

        var Period = Number(document.getElementById("loan_period").value);
        var Installment_Type = Number(document.getElementById("installment_type").value);
        var NumVal = Number(document.getElementById("loan_amount").value);
        var NumVa2 = Number(document.getElementById("interest_rate").value) / 100;
        var Month = (Period / 30);

        //cal total value in month
        var TotalValue = NumVal + (Month * (NumVal * NumVa2));

        //echo total
        document.getElementById("total").value = TotalValue.toFixed(2);

        //cal installment type
        var Installment_Type = (TotalValue / Installment_Type);

        //echo  installment type
        document.getElementById("Installment_Type").value = Installment_Type.toFixed(2);

    });
});
