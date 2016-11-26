@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="admin-container">
        <div class="container">
            <div class="admin-block users-edit">
                {!! adminHeaderTitle() !!}

                <div class="admin-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul class="sidebar-menu list-unstyled">
                                @foreach($sections as $s)
                                    <li>
                                        <a href="{{ route('users.edit', [$user->id, $s]) }}" class="@if($section == $s) active @endif">
                                            <span class="fa @if($section == $s) fa-circle @else fa-circle-o @endif text-aqua"></span>
                                            <span class="title">{{ trans("common.profile.sections.$s") }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-7">
                            {!! Former::open_for_files()->route('users.update', $user->id)->method('put') !!}

                                @include("admin.users.partials.$section")

                                <hr>

                                {!! Former::actions()->first_lg_submit('common.save') !!}

                            {!! Former::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection