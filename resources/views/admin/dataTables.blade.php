@section('styles')
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            var options = {
                pageLength: 50,
                stateSave: true,
                language: {
                    emptyTable: "Nėra duomenų",
                    search: "Paieška",
                    info: "Rodo _START_ - _END_ iš _TOTAL_",
                    infoEmpty: "",
                    lengthMenu: "Rodyti po _MENU_",
                    paginate: {
                        first: "Pirmas",
                        last: "Paskutinis",
                        next: "»",
                        previous: "«"
                    }
                }
            };

            options.columnDefs = [{
                'orderable': false,
                'searchable': false,
                'targets': -1,
                'data': null,
                'render': function ( data, type, row, meta ) {
                    return row[row.length-1];
                }
            }];

            if (dataTableOptions.cellObject !== undefined) {

                for (var key in dataTableOptions.cellObject) {
                    var num = dataTableOptions.cellObject[key];
                    options.columnDefs.push({
                        data: num,
                        targets: num,
                        render: function (data, type, row, meta) {
                            if (type == 'display') {
                                return data.display;
                            }

                            return data.value;
                        }
                    });

                }
            }

            if (dataTableOptions !== undefined) {
                $.extend(options, dataTableOptions);
            }

            $('.data-table').DataTable(options);
        });
    </script>

@endsection