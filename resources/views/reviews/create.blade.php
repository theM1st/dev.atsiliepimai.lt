@extends('layouts.app')

@section('title', getTitle('Parašyti atsiliepimą apie ' . $listing->title))

@section('content')
    <section class="main-section review-create">
        <div class="container">
            <h2>Parašyti atsiliepimą</h2>

            <div class="row">
                <div class="col-sm-8">
                    <div class="listing-picture">
                        <img src="{{ $listing->getPicture() }}" alt="" class="img-responsive img-circle img-border-grey">
                    </div>
                    <div class="listing-title">
                        {{ $listing->title }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('listing.create') }}" class="listing-search">Parašyti apie kažką kitą</a>
                </div>
            </div>
            <hr>
            {!! Former::open()->route('review.store', $listing->slug)->method('post')->id('review-form') !!}
                {!!
                    Former::text('rating')
                        ->label(trans('common.form.review.rating', ['name' => $listing->title]))
                !!}
                {!!
                    Former::text('review_title')->label('common.form.review.title')
                        ->placeholder('common.form.review.title_placeholder')
                        ->help('common.form.review.title_help')
                !!}

                @if ($attribute = $listing->getMainAttribute())
                    {!!
                        Former::select('attribute_option_id['.$attribute->id.']')
                        ->options(
                            $attribute->options->pluck('option_name', 'id')->put(0, trans('common.form.review.cannot_find_my_option'))
                        )
                        ->class('form-control selectpicker')
                        ->title(trans('common.form.select'))
                        ->label($attribute->title)
                    !!}
                    <div class="attribute-option-value" style="display: none">
                        {!!
                            Former::text('option_value['.$attribute->id.']')
                                ->disabled()
                                ->label('common.form.review.write_your_option')
                        !!}
                    </div>
                @endif

                {!!
                    Former::textarea('review_description')
                        ->rows(4)
                        ->placeholder('common.form.review.description_placeholder')
                        ->label('common.form.review.description')
                        ->help('common.form.review.description_help')
                !!}

                <hr>
                {!! Former::actions()->first_lg_submit('Siųsti atsiliepimą') !!}
            {!! Former::close() !!}
        </div>
    </section>
@endsection

@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script>
        starRating($(".review-create #rating"), { size: 'md' });

        (function(form) {
            var optId = form.find('[id^=attribute_option_id]');

            if (parseInt(optId.val()) === 0) {
                toggleOptionValue('show');
            }

            optId.change(function() {
                if (parseInt($(this).val()) === 0) {
                    toggleOptionValue('show');
                } else {
                    toggleOptionValue('hide');
                }
            });

            function toggleOptionValue(a) {
                var optValue = form.find('.attribute-option-value');
                if (a == 'show') {
                    optValue.show();
                    optValue.find('[id^=option_value]').prop('disabled', false);
                } else if (a == 'hide') {
                    optValue.hide();
                    optValue.find('[id^=option_value]').prop('disabled', true);
                }
            }

        })($('#review-form'));
    </script>
@endsection