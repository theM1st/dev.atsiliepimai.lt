<div class="col-sm-9 col-md-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2">Atsiliepimas</th>
                <th>Produktas/Paslauga</th>
                <th>Įvertinimas</th>
                <th>Data</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $r)
                <tr>
                    <td>
                        <div class="label{{ $r->active ? '  label-success' : ' label-warning' }}">
                            {{ $r->active ? 'Aktyvuotas' : 'Tvirtinamas' }}
                        </div>
                    </td>
                    <td>{{ str_limit($r->review_title, 50) }}</td>
                    <td>
                        @if (count($r->listing->reviews) == 0)
                            <span>{{ str_limit($r->listing->title, 50) }}</span>
                        @else
                            <a href="{{ route('listing.show', $r->listing->slug) }}">{{ str_limit($r->listing->title, 50) }}</a>
                        @endif
                    </td>
                    <td>{!! starRating($r->rating) !!}</td>
                    <td>{{ $r->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('profile.editReview', $r->id) }}" class="btn btn-link">Redaguoti</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>