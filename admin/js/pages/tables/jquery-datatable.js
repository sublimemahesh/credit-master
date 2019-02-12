$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        iDisplayLength: 100,
        aLengthMenu: [[100, 500, 1000, 2000, -1], [100, 500, 1000, 2000, "All"]]
    });

    //Exportable table
//    $('.js-exportable').DataTable({
//        dom: 'Bfrtip',
//        responsive: true,
//        buttons: [
//            'copy', 'csv', 'excel', 'pdf', 'print'
//        ]
//    });
});