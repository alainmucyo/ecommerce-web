var table = $('.table').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    "aaSorting": [],
   /* "columnDefs": [
        {"orderable": false, "targets": 0}
    ],*/
    /*        "columnDefs": [
           {
               "targets": [ 1,2,3 ],
               "visible": false,
               "searchable": true
           },

       ],*/
    lengthChange: true,
    buttons: [{
        extend: 'copy',
        exportOptions: {
            columns: ':visible'
        }
    }, {
        extend: 'excel',
        exportOptions: {
            columns: ':visible'
        }
    }, {
        extend: 'pdf',
        exportOptions: {
            columns: ':visible'
        }
    }, {
        extend: 'print',
        exportOptions: {
            columns: ':visible'
        }
    }, 'colvis']

});
table.buttons().container()
    .appendTo('#example_wrapper .col-sm-6:eq(0)');
$("#data").on("click", "tbody tr", function () {

})
