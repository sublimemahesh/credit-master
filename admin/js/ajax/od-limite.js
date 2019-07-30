/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
/* ----------------------commented at 2019-07-25 by Kavini----------------------- */
//Create od limit

//    $('#create-od').click(function (event) {
//        event.preventDefault();
//        //declared variables
//        var start_date = $('#od_date_start').val();
//        var end_date = $('#od_date_end').val();
//        var od_limite = $('#od_interest_limit').val();
//        //check conditions
//        if (!start_date || !od_limite) {
//            swal({
//                title: "Error!..",
//                text: "Od start date, Od interest limit  is required..!",
//                type: "error"
//            });
//        } else if (start_date == end_date) {
//            swal({
//                title: "Error!..",
//                text: "You are entered same dates..! Please check it..",
//                type: "error"
//            });
//        } else if (!end_date) {
////Check od dates 
//            //Check od dates 
//            $.ajax({
//                url: "post-and-get/ajax/active-od-limite.php",
//                type: 'POST',
//                data: {
//                    id: $('#id').val(),
//                    od_date_start: start_date,
//                    od_date_end: end_date,
//                    action: 'CHECKODDATES'
//                },
//                dataType: "JSON",
//                success: function (jsonStr) {
//                    //Check date range
//                    if (jsonStr.status) {
//
//                        if (jsonStr.od_date_start == start_date) {
//                            swal({
//                                title: "Error!",
//                                text: "Your are enter the start date is same.!",
//                                type: 'error',
//                                timer: 2000,
//                                showConfirmButton: false
//                            });
//                            setTimeout(function () {
//                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                            }, 2000);
//                        } else if (jsonStr.arr_od_end_date == end_date) {
//                            swal({
//                                title: "Error!",
//                                text: "Your are enter the end date is same.!",
//                                type: 'error',
//                                timer: 2000,
//                                showConfirmButton: false
//                            });
//                            setTimeout(function () {
//                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                            }, 2000);
//                        } else {
//                            swal({
//                                html: true,
//                                title: "You can not add this date range!...",
//                                text: "This date range is allredy adding, OD start date is" + '<span style="font-weight:600;color:red;">  ' + jsonStr.od_date_start + '</span>' + "  to End date is " + '<span style="font-weight:600;color:red;">  ' + jsonStr.od_date_end + '</span>' + "",
//                                type: "error",
//                                showCancelButton: true,
//                                confirmButtonColor: "#00b0e4",
//                                confirmButtonText: "Yes, active It!",
//                                closeOnConfirm: false
//                            }, function () {
//                                //send form date  create od
//                                var formData = new FormData($("form#form-data")[0]);
//                                $.ajax({
//                                    url: "post-and-get/ajax/update-od-date-range.php",
//                                    type: 'POST',
//                                    data: formData,
//                                    async: false,
//                                    cache: false,
//                                    contentType: false,
//                                    processData: false,
//                                    dataType: "JSON",
//                                    success: function (jsonStr) {
//                                        if (jsonStr.status) {
//                                            swal({
//                                                title: "Actived!",
//                                                text: "Od limite is actived..!",
//                                                type: 'success',
//                                                timer: 2000,
//                                                showConfirmButton: false
//                                            });
//                                            setTimeout(function () {
//                                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                                            }, 2000);
//                                        } else {
//                                            alert('Error');
//                                        }
//                                    }
//                                });
//                            });
//                        }
//
//                        //active od
//                    } else {
//                        swal({
//                            title: "Active!",
//                            text: "Do you really want to active od limite in this loan?...",
//                            type: "info",
//                            showCancelButton: true,
//                            confirmButtonColor: "#00b0e4",
//                            confirmButtonText: "Yes, active It!",
//                            closeOnConfirm: false
//                        }, function () {
//                            //send form date  create od
//                            var formData = new FormData($("form#form-data")[0]);
//                            $.ajax({
//                                url: "post-and-get/ajax/od-create.php",
//                                type: 'POST',
//                                data: formData,
//                                async: false,
//                                cache: false,
//                                contentType: false,
//                                processData: false,
//                                dataType: "JSON",
//                                success: function (jsonStr) {
//                                    if (jsonStr.status) {
//                                        swal({
//                                            title: "Actived!",
//                                            text: "Od limite is actived..!",
//                                            type: 'success',
//                                            timer: 2000,
//                                            showConfirmButton: false
//                                        });
//                                        setTimeout(function () {
//                                            window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                                        }, 2000);
//                                    } else {
//                                        alert('Error');
//                                    }
//                                }
//                            });
//                        });
//                    }
//                }
//            });
//
//            //date is has
//        } else if (end_date) {
//
//            //Check od dates 
//            $.ajax({
//                url: "post-and-get/ajax/active-od-limite.php",
//                type: 'POST',
//                data: {
//                    id: $('#id').val(),
//                    od_date_start: start_date,
//                    od_date_end: end_date,
//                    action: 'CHECKODDATES'
//                },
//                dataType: "JSON",
//                success: function (jsonStr) {
//                    //Check date range
//                    if (jsonStr.status) {
//
//                        if (jsonStr.od_date_start == start_date) {
//                            swal({
//                                title: "Error!",
//                                text: "Your are enter the start date is same.!",
//                                type: 'error',
//                                timer: 2000,
//                                showConfirmButton: false
//                            });
//                            setTimeout(function () {
//                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                            }, 2000);
//                        } else if (jsonStr.arr_od_end_date == end_date) {
//                            swal({
//                                title: "Error!",
//                                text: "Your are enter the end date is same.!",
//                                type: 'error',
//                                timer: 2000,
//                                showConfirmButton: false
//                            });
//                            setTimeout(function () {
//                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                            }, 2000);
//                        } else {
//                            swal({
//                                html: true,
//                                title: "You can not add this date range!...",
//                                text: "This date range is allredy adding, OD start date is" + '<span style="font-weight:600;color:red;">  ' + jsonStr.od_date_start + '</span>' + "  to End date is " + '<span style="font-weight:600;color:red;">  ' + jsonStr.od_date_end + '</span>' + "",
//                                type: "error",
//                                showCancelButton: true,
//                                confirmButtonColor: "#00b0e4",
//                                confirmButtonText: "Yes, active It!",
//                                closeOnConfirm: false
//                            }, function () {
//                                //send form date  create od
//                                var formData = new FormData($("form#form-data")[0]);
//                                $.ajax({
//                                    url: "post-and-get/ajax/update-od-date-range.php",
//                                    type: 'POST',
//                                    data: formData,
//                                    async: false,
//                                    cache: false,
//                                    contentType: false,
//                                    processData: false,
//                                    dataType: "JSON",
//                                    success: function (jsonStr) {
//                                        if (jsonStr.status) {
//                                            swal({
//                                                title: "Actived!",
//                                                text: "Od limite is actived..!",
//                                                type: 'success',
//                                                timer: 2000,
//                                                showConfirmButton: false
//                                            });
//                                            setTimeout(function () {
//                                                window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                                            }, 2000);
//                                        } else {
//                                            alert('Error');
//                                        }
//                                    }
//                                });
//                            });
//                        }
//
//                        //active od
//                    } else {
//                        swal({
//                            title: "Active!",
//                            text: "Do you really want to active od limite in this loan?...",
//                            type: "info",
//                            showCancelButton: true,
//                            confirmButtonColor: "#00b0e4",
//                            confirmButtonText: "Yes, active It!",
//                            closeOnConfirm: false
//                        }, function () {
//                            //send form date  create od
//                            var formData = new FormData($("form#form-data")[0]);
//                            $.ajax({
//                                url: "post-and-get/ajax/od-create.php",
//                                type: 'POST',
//                                data: formData,
//                                async: false,
//                                cache: false,
//                                contentType: false,
//                                processData: false,
//                                dataType: "JSON",
//                                success: function (jsonStr) {
//                                    if (jsonStr.status) {
//                                        swal({
//                                            title: "Actived!",
//                                            text: "Od limite is actived..!",
//                                            type: 'success',
//                                            timer: 2000,
//                                            showConfirmButton: false
//                                        });
//                                        setTimeout(function () {
//                                            window.location.replace("view-active-loan.php?id=" + jsonStr.id);
//                                        }, 2000);
//                                    } else {
//                                        alert('Error');
//                                    }
//                                }
//                            });
//                        });
//                    }
//                }
//            });
//        } else if (start_date > end_date) {
//            swal({
//                title: "Error!..",
//                text: "End date is minimun Start date..! Please chek it..",
//                type: "error"
//            });
//        }
//    });

/* ---------------------- //commented at 2019-07-25 by Kavini----------------------- */
// update od limit
    $('#update-od').click(function () {
        var formData = new FormData($("form#form-data")[0]);
        $.ajax({
            url: "post-and-get/ajax/update-od-limit.php",
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
                        text: "Od limit is actived..!",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.replace("view-active-loan.php?id=" + jsonStr.id);
                    }, 3000);
                } else {
                    alert('Error');
                }
            }
        });
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
}
); 