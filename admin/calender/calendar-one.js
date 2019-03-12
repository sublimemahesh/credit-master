jQuery(document).ready(function() {

    jQuery('.calendar-navigation').click(function() {
        showLoading();
        var month = parseInt(jQuery('#month').val(), 10);
        var year = parseInt(jQuery('#year').val(), 10);

        if (this.id == 'next') {
            if (month == 12) {
                month = 0;
                jQuery('#year').val(year + 1);
            }
            jQuery('#month').val(month);
        }

        if (this.id == 'back') {

            if (month == 1) {
                month = 13;
                jQuery('#year').val(year - 1);
            }
            jQuery('#month').val(month);
        }

        var data = {
            "month": jQuery('#month').val(),
            "year": jQuery('#year').val(),
            
        };

        jQuery.post("calendar/calendar-controller.php", data, function(data) {
            jQuery("#result").html(data);
            hideLoading();
        });
    });



    showLoading();
    var data = {
        "month": jQuery('#month').val(),
        "year": jQuery('#year').val(),
        
    };

    jQuery.post("calendar/calendar-controller.php", data, function(data) {
        jQuery("#result").html(data);
        hideLoading()
    });
});


function showLoading() {
    jQuery('#blue-013-loading').show();
    jQuery('#result').css('opacity', '0.2');
}
function hideLoading() {
    jQuery('#blue-013-loading').hide();
    jQuery('#result').css('opacity', '1');
}
        