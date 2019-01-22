$(document).ready(function () {
    $('#registration_type').change(function () {

        var type = $(this).val();

        var center_leader = $("#center_leader").val();
        if (!type || center_leader == 1) {
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

    $('#edit_registration_type').change(function () {

        var type = $(this).val();
        var center_leader = $("#center_leader").val();

        if (!type || center_leader == 1) {
            $('#route_row').hide();
            $('#center_row').hide();

        }
        ;

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

    $('#add-new-branch').click(function () {

        var bankId = $("#selected_bank").attr("bankId");
        var branchName = $('#new_branch').val();

        if (branchName == '') {
            swal({
                title: "Branch Name Required .!",
                text: "Please enter branch name..",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            });
        } else {
            $.ajax({
                url: "post-and-get/ajax/customer.php",
                type: "POST",
                data: {
                    bank_id: bankId,
                    branch_name: branchName,
                    action: 'ADDBRANCHNAME'
                },
                dataType: "JSON",
                success: function (jsonStr) {

                    var html = '<option> -- Please Select a Branch -- </option>';
                    $.each(jsonStr.branches, function (i, branches) {
                        if (jsonStr.result['id'] === branches.id) {
                            html += '<option selected="true" value="' + branches.id + '">';
                            html += branches.name;
                            html += '</option>';
                        } else {
                            html += '<option value="' + branches.id + '">';
                            html += branches.name;
                            html += '</option>';
                        }
                    });
                    $('#branch').empty();
                    $('#branch').append(html);
                    $('#branch_row').show();
                    $('#exampleModalCenter').modal('hide');
                }
            });
        }

    });

    $('#bank_id').change(function () {

        var bank_id = $(this).val();
        var bank_name = $(this).find('option:selected').text();

        $('#selected_bank').val(bank_name);
        $('#selected_bank').attr("bankId", bank_id);

        $.ajax({

            url: "post-and-get/ajax/customer.php",
            type: "POST",
            data: {
                bank_id: bank_id,
                action: 'GETBANKNAME'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option> -- Please Select a Branch -- </option>';
                $.each(jsonStr.data, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#branch').empty();
                $('#branch').append(html);
                $('#branch_row').show();

            }
        });
    });

//    $('.check-customer').click(function () {
//
//        var nicNumber = $('#customer-nic').val();
//        var mobileNumber = $('#moblie_number').val();
//
//        if (nicNumber.match(/^.*[^\s{1,}]\s.*/) || nicNumber == '') {
//            swal({
//                title: "Space characters not alowded in NIC Number.!",
//                text: "containing space characters in nic number column..",
//                type: "info",
//                showCancelButton: false,
//                confirmButtonColor: "#00b0e4",
//                confirmButtonText: "Enter Again.!",
//                closeOnConfirm: false
//            });
//            return false;
//        } else if (mobileNumber.match(/^.*[^\s{1,}]\s.*/) || mobileNumber == '') {
//            swal({
//                title: "Space characters not alowded in Mobile Number.!",
//                text: "containing space characters in mobile number column..",
//                type: "info",
//                showCancelButton: false,
//                confirmButtonColor: "#00b0e4",
//                confirmButtonText: "Enter Again.!",
//                closeOnConfirm: false
//            });
//            return false;
//        } else {
//
//            $.ajax({
//                url: "post-and-get/ajax/customer.php",
//                type: "POST",
//                data: {
//                    MobileNumber: mobileNumber,
//                    NicNumber: nicNumber,
//                    action: 'CHECKNIC&MOBILEINCUSTOMER'
//                },
//                dataType: "JSON",
//                success: function (jsonStr) {
//                    if (jsonStr.status == 'nicIsExist') {
//                        swal({
//                            title: "Duplicate NIC Number.!",
//                            text: "You entered the duplicate NIC Number..",
//                            type: "info",
//                            showCancelButton: false,
//                            confirmButtonColor: "#00b0e4",
//                            confirmButtonText: "Enter Again.!",
//                            closeOnConfirm: false
//                        });
//                        return false;
//                    } else if (jsonStr.status == 'mobileIsExist') {
//                        swal({
//                            title: "Duplicate Mobile Number.!",
//                            text: "You entered the duplicate Mobile Number..",
//                            type: "info",
//                            showCancelButton: false,
//                            confirmButtonColor: "#00b0e4",
//                            confirmButtonText: "Enter Again.!",
//                            closeOnConfirm: false
//                        });
//                        return false;
//                    } else {
//                        return true;
//                    }
//                }
//
//            });
//
//        }
//    });



// customer create form

    $("#customerform").submit(function (e) {

        var errors = $('#errors').val();
        if (errors == 1) {
            e.preventDefault();
            $('#errors').val(0);
        }

        var nicNumber = $('#customer-nic').val();
        var mobileNumber = $('#moblie_number').val();

        //chech 18+ years in customer
        var month = $('#month').val();
        var day = $('#day').val();
        var year = $('#year').val();
        var age = 18;
        var birthday = new Date();
        birthday.setFullYear(year, month - 1, day);
        var currdate = new Date();
        currdate.setFullYear(currdate.getFullYear() - age);



        if (nicNumber.match(/^.*[^\s{1,}]\s.*/) || nicNumber == '') {
            $('#errors').val(1);
            swal({
                title: "Space characters not alowded in NIC Number.!",
                text: "containing space characters in nic number column..",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false},
                    function () {
                        swal.close();
                        $('html, body').animate({
                            scrollTop: $("#surname").offset().top
                        }, 1000);
                        $('#customer-nic').focus();
                    });
        } else if (mobileNumber.match(/^.*[^\s{1,}]\s.*/) || mobileNumber == '') {
            $('#errors').val(1);
            swal({
                title: "Space characters not alowded in Mobile Number.!",
                text: "containing space characters in mobile number column..",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            }, function () {
                swal.close();
                $('html, body').animate({
                    scrollTop: $("#email").offset().top
                }, 1000);
                $('#moblie_number').focus();
            });
        } else if ((currdate - birthday) < 0) {
            $('#errors').val(1);
            swal({
                title: "This Customer below 18 years..!",
                text: "This Customer below 18 years old you ..",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            }, function () {
                swal.close();
                $('html, body').animate({
                    scrollTop: $("#profile_picture").offset().top
                }, 1000);
                $('#month').focus();
            });
        } else {

            $.ajax({
                url: "post-and-get/ajax/customer.php",
                type: "POST",
                data: {
                    MobileNumber: mobileNumber,
                    NicNumber: nicNumber,
                    action: 'CHECKNIC&MOBILEINCUSTOMER'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'nicIsExist') {
                        $('#errors').val(1);
                        swal({
                            title: "Duplicate NIC Number.!",
                            text: "You entered the duplicate NIC number..",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Enter Again.!",
                            closeOnConfirm: false
                        }, function () {
                            swal.close();
                            $('html, body').animate({
                                scrollTop: $("#surname").offset().top
                            }, 1000);
                            $('#customer-nic').focus();
                        });

                    } else if (jsonStr.status == 'mobileIsExist') {
                        $('#errors').val(1);
                        swal({
                            title: "Duplicate Mobile Number.!",
                            text: "You entered the duplicate mobile number..",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Enter Again.!",
                            closeOnConfirm: false
                        }, function () {
                            swal.close();
                            $('html, body').animate({
                                scrollTop: $("#email").offset().top
                            }, 1000);
                            $('#moblie_number').focus();
                        });
                    } else if (jsonStr.status == 'false') {
                        $('#errors').val(0);
                        $('#customerform').unbind().submit();
                    }
                }
            });

        }

    });



//customer edit form
    $("#form").submit(function (e) {
        var errors = $('#errors').val();
        if (errors == 1) {
            e.preventDefault();
            $('#errors').val(0);
        }

        var id = $('#id').val();
        var nicNumber = $('#customer_nic_number').val();
        var mobileNumber = $('#customer_moblie_number').val();


        //chech 18+ years in customer
        var month = $('#month').val();
        var day = $('#day').val();
        var year = $('#year').val();
        var age = 18;
        var birthday = new Date();
        birthday.setFullYear(year, month - 1, day);
        var currdate = new Date();
        currdate.setFullYear(currdate.getFullYear() - age);



        if (nicNumber.match(/^.*[^\s{1,}]\s.*/) || nicNumber == '') {
            $('#errors').val(1);
            swal({
                title: "Space characters not alowded in NIC Number.!",
                text: "containing space characters in nic number column..",
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            }, function () {
                swal.close();
                $('html, body').animate({
                    scrollTop: $("#surname").offset().top
                }, 1000);
                $('#customer_nic_number').focus();
            });

        } else if (mobileNumber.match(/^.*[^\s{1,}]\s.*/) || mobileNumber == '') {
            $('#errors').val(1);
            swal({
                title: "Space characters not alowded in Mobile Number.!",
                text: "containing space characters in mobile number column..",
                type: "info",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            }, function () {
                swal.close();
                $('html, body').animate({
                    scrollTop: $("#email").offset().top
                }, 1000);
                $('#customer_moblie_number').focus();
            });
        } else if ((currdate - birthday) < 0) {
            $('#errors').val(1);
            swal({
                title: "This Customer Below 18 years..!",
                text: "This Customer below 18 years old you ..",
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#00b0e4",
                confirmButtonText: "Enter Again.!",
                closeOnConfirm: false
            }, function () {
                swal.close();
                $('html, body').animate({
                    scrollTop: $("#profile_picture").offset().top
                }, 1000);
                $('#month').focus();
            });
        } else {
            $.ajax({
                url: "post-and-get/ajax/customer.php",
                type: "POST",
                data: {
                    id: id,
                    nicNumber: nicNumber,
                    mobileNumber: mobileNumber,
                    action: 'CHECKNIC&MOBILEEXISTCUSTOMER'
                },
                dataType: "JSON",
                success: function (jsonStr) {

                    if (jsonStr.status == 'nicIsExist') {
                        $('#errors').val(1);
                        swal({
                            title: "Duplicate NIC Number.!",
                            text: "You entered the duplicate NIC number..",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Enter Again.!",
                            closeOnConfirm: false
                        }, function () {
                            swal.close();
                            $('html, body').animate({
                                scrollTop: $("#surname").offset().top
                            }, 1000);
                            $('#customer_nic_number').focus();
                        });

                    } else if (jsonStr.status == 'mobileIsExist') {
                        $('#errors').val(1);
                        swal({
                            title: "Duplicate Mobile Number.!",
                            text: "You entered the duplicate mobile number..",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#00b0e4",
                            confirmButtonText: "Enter Again.!",
                            closeOnConfirm: false
                        }, function () {
                            swal.close();
                            $('html, body').animate({
                                scrollTop: $("#email").offset().top
                            }, 1000);
                            $('#customer_moblie_number').focus();
                        });
                    } else if (jsonStr.status == 'fales') {
                        $('#errors').val(0);
                        $('#form').unbind().submit();
                    }
                }
            });
        }
    });

});
