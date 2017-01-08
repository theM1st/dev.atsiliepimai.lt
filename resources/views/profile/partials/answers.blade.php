<div class="col-sm-9 col-md-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Atsakymas</th>
                <th>Produktas/Paslauga</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($answers as $a)
                <tr>
                    <td>{{ str_limit($a->title, 60) }}</td>
                    <td>
                        <a href="{{ route('listing.show', $a->question->listing->slug) }}">
                            {{ str_limit($a->question->listing->title, 60) }}
                        </a>
                    </td>
                    <td>{{ $a->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>