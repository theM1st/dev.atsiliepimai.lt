@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block listings-create">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                {!! Former::open_for_files()->route('listings.update', $listing->id)->method('put') !!}
                    <div class="row">
                        <div class="col-md-5">
                            @if ($listing->getPicture())
                                <img src="{{ $listing->getPicture() }}" alt="" class="img-responsive img-circle img-border-grey">
                            @endif

                            @include('admin.listings.form.elements')
                        </div>
                        <div class="col-md-7">
                            <h3>{{ trans('common.form.listing.description') }}</h3>
                            {!!
                                Former::textarea('description')->label('')
                            !!}
                        </div>
                    </div>
                    <hr>
                    {!! Former::actions()->first_lg_submit('common.update') !!}
                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection

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
            $('#description').froalaEditor({
                heightMin: 300,
                toolbarButtons: ['bold', 'italic', 'color', '|', 'indent', 'outdent', 'formatOL', 'formatUL', '|',
                    'insertLink', 'insertTable', 'html']
            });
            $('.fr-box div:last').remove();
        });
    </script>
@endsection