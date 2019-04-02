/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

//Create od limite
    $('#create-od').click(function (event) {
        event.preventDefault();
        //Check od form
        if (!$('#od_date_start').val() || !$('#od_interest_limit').val()) {
            swal({
                title: "Error!..",
                text: "Od start date, Od interest limit  is required..!",
                type: "error"
            });
        } else if ($('#od_date_start').val() > $('#od_date_end').val()) {
            swal({
                title: "Error!..",
                text: "Od end date minimum Od start date.  Please check it..!",
                type: "error"
            });
        } else {
            //Check od dates 
            $.ajax({
                url: "post-and-get/ajax/active-od-limite.php",
                type: 'POST',
                data: {
                    id: $('#id').val(),
                    od_date_start: $('#od_date_start').val(),
                    od_date_end: $('#od_date_end').val(),
                    action: 'CHECKODDATES',
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    //Check date range
                    if (jsonStr.status) {
                        swal({
                            title: "You can not add this date range!...",
                            text: "This date range is allredy adding, please end your od or select the another date range ..",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Ok.!",
                            closeOnConfirm: false
                        });
                        //active od
                    } else {
                        swal({
                            title: "Active!",
                            text: "Do you really want to active od limite in this loan?...",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Yes, active It!",
                            closeOnConfirm: false
                        }, function () {
                            //send form date  create od
                            var formData = new FormData($("form#form-data")[0]);
                            $.ajax({
                                url: "post-and-get/ajax/od-create.php",
                                type: 'POST',
                                data: formData,
                                async: false,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "JSON",
                                success: function (jsonStr) {
                                    if (jsonStr.status) {
                                        swal({
                                            title: "Actived!",
                                            text: "Od limite is actived..!",
                                            type: 'success',
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                        setTimeout(function () {
                                            window.location.replace("view-active-loan.php?id=" + jsonStr.id);
                                        }, 2000);
                                    } else {
                                        alert('Error');
                                    }
                                }
                            });
                        });
                    }
                }
            });
        }
    });

    //Edit od in validation dates
    $('#edit-od').click(function (event) {
        event.preventDefault();
        
        var today = $('#today').val();
        var enddate = $('#od_date_end').val();

        //validate the date in today
        if (today < enddate) {
            swal({
                title: "Change!",
                text: "Do you really want to change the od date?...",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Yes, change It!",
                closeOnConfirm: false
            }, function () {
                //validate true send edit form data
                var formData = new FormData($("form#form-data")[0]);
                $.ajax({
                    url: "post-and-get/ajax/edit-od.php",
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr.status) {
                            swal({
                                title: "Changed!",
                                text: "Od limite date is Changed..!",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(function () {
                                window.location.replace("view-active-loan.php?id=" + jsonStr.loan_id);
                            }, 2000);
                        } else {
                            alert('Error');
                        }
                    }
                });
            });
            //validate false show error Message
        } else {
            swal({
                title: "You can not add this date to end date!...",
                text: "Please select the end date is more than today....",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Ok.!",
                closeOnConfirm: false
            });
        }

    });
});


// Windows on loard functions 

window.onload = function () {

    //Show alert Message 
    var loan_id = $('#loan_id').val();
    $.ajax({
        url: "post-and-get/ajax/active-od-limite.php",
        type: 'POST',
        data: {
            id: loan_id,
            action: 'CHECKOD'
        },
        dataType: "JSON",
        success: function (jsonStr) {
            if (jsonStr.status) {
            } else {
                $('#od_limit').append("<div class='alert alert-danger'> <strong>This Customer has not active od amount, Please check it now..!</strong></div>");
            }
        }
    });
}


