@extends('layouts.app')

@section('title', getTitle($page, 'title'))
@section('description', getDescription($page))

@section('content')
    <section class="main-section messages-index">
        <div class="container">
            <h2>{{ $page->title }}</h2>

            @if ($page->slug == 'kontaktai')
                {!! Former::open()->route('page.sendMessage')->method('post') !!}
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! Former::text('name')->label('common.user.your_first_name') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::email('email')->label('common.user.email') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! Former::text('telephone')->label('common.user.telephone') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::text('subject')->label('Žinutės tema') !!}
                                </div>
                            </div>
                            {!! Former::textarea('message')->label('Žinutė')->rows(4) !!}
                            <hr>
                            {!! Former::actions()->first_lg_submit('SIŲSTI') !!}
                        </div>
                        <div class="col-sm-4">
                            {!! $page->content !!}
                        </div>
                    </div>
                {!! Former::close() !!}
            @else
                {!! $page->content !!}
            @endif
        </div>
    </section>
@endsection