<div class="col-sm-9 col-md-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Klausimas</th>
                <th>Produktas/Paslauga</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $q)
                <tr>
                    <td>{{ str_limit($q->title, 60) }}</td>
                    <td>
                        <a href="{{ route('listing.show', $q->listing->slug) }}">
                            {{ str_limit($q->listing->title, 60) }}
                        </a>
                    </td>
                    <td>{{ $q->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>