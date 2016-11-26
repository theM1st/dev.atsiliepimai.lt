@if (session()->has('alert.message'))
    <div class="container">
        <div class="alert alert-global alert-{{ session('alert.type') }}">
            {{ session('alert.message') }}
        </div>
    </div>
@endif