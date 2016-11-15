@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container users-edit">
        {!! adminHeaderTitle() !!}
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    @foreach($sections as $s)
                        <a href="{{ route('users.edit', [$user->id, $s]) }}" class="list-group-item @if($section == $s) active @endif">
                            {{ trans("common.profile.sections.$s") }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-7">
                {!! Former::open_for_files()->route('users.update', $user->id)->method('put') !!}

                    @include("admin.users.partials.$section")

                    {!! Former::actions()->primary_submit('common.save') !!}

                {!! Former::close() !!}
            </div>
        </div>
    </div>
@endsection