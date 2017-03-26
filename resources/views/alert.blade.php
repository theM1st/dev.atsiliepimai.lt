@if (session()->has('alert.message'))
    <div class="container">
        <div class="alert alert-global alert-{{ session('alert.type') }}">
            {{ session('alert.message') }}
        </div>
    </div>
@endif

@if (isset($errors) && count($errors) > 0)
    <div class="container">
        <div class="alert alert-global alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif