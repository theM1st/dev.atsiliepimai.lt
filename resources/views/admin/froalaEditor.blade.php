@section('styles')
    <link rel="stylesheet" href="{{ asset('css/froala-editor/froala_editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/froala-editor/froala_style.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <link rel="stylesheet" href="{{ asset('css/froala-editor/plugins/code_view.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/froala-editor/plugins/table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/froala-editor/plugins/colors.min.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/froala-editor/froala_editor.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/code_view.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/code_beautifier.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/link.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/froala-editor/plugins/colors.min.js') }}"></script>
    <script>
        $(function() {
            var options = {
                heightMin: 300,
                toolbarButtons: ['bold', 'italic', 'color', '|', 'indent', 'outdent', 'formatOL', 'formatUL', '|',
                    'insertLink', 'insertTable', 'html']
            };
            $('.froala-editor').froalaEditor(options);
            $('.fr-box div:last').remove();
        });
    </script>
@endsection