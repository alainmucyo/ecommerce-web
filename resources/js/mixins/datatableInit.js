export const DatatableInit = {
    methods: {
        datatableMain(visible, num) {
            var table = $('.table').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                destroy: true,

                "columnDefs": [
                    {
                        "targets": [num],
                        "visible": visible,
                        "searchable": true
                    },

                ],

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
                }, 'colvis'],
                "bLengthChange": true,

            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-sm-6:eq(0)');
            $("#data").on("click", "tbody tr", function () {

            })
        },

        datatableInit() {
            $(".table").DataTable().destroy();
            setTimeout(() => {
                this.datatableMain(true, 1)
            }, 1500)
        }
    }
}