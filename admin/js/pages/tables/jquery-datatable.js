$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        iDisplayLength: 20,
        aLengthMenu: [[20, 50, 100, 200, -1], [20, 50, 100, 200, "All"]]
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