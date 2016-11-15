@section('styles')
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection
@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            var options = {
                "columnDefs": [{
                    'orderable': false,
                    'searchable': false,
                    'targets': -1,
                    'data': null,
                    'render': function ( data, type, row, meta ) {
                        return row[row.length-1];
                    }
                }],
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
                        next: "Senesnis",
                        previous: "Naujesnis"
                    },
                }
            };

            if (typeof dataTableOptions !== 'undefined') {
                $.extend(options, dataTableOptions);
            }

            $('.data-table').DataTable(options);
        });
    </script>

@endsection