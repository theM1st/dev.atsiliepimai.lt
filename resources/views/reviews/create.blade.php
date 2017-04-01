@extends('layouts.app')

@section('title', getTitle('Parašyti atsiliepimą apie ' . $listing->title))

@section('content')
    <section class="main-section review-create">
        <div class="container">
            <h2>Parašyti atsiliepimą</h2>

            <div class="row">
                <div class="col-sm-8">
                    <div class="listing-picture img-circle img-circle-md img-border-grey">
                        <img src="{{ $listing->getPicture() }}" alt="" class="img-responsive">
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
                    <div id="value_attribute_option_id{{ $attribute->id }}" style="display: none">
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

                @if ($attributes = $listing->getSecondaryAttributes())
                    @foreach ($attributes as $attribute)
                        {!!
                            Former::select('attribute_option_id['.$attribute->id.']')
                            ->options(
                                $attribute->options->pluck('option_name', 'id')->put(0, trans('common.form.review.cannot_find_my_option'))
                            )
                            ->class('form-control selectpicker')
                            ->title(trans('common.form.select'))
                            ->label($attribute->title)
                        !!}
                        <div id="value_attribute_option_id{{ $attribute->id }}" style="display: none">
                            {!!
                                Former::text('option_value['.$attribute->id.']')
                                    ->disabled()
                                    ->label('common.form.review.write_your_option')
                            !!}
                        </div>
                    @endforeach
                @endif

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
            form.find('[id^=attribute_option_id]').each(function(){
                var optId = $(this);

                var $optValue = $('#value_' + optId.attr('id').replace('[', '').replace(']', ''));

                if (parseInt(optId.val()) === 0) {
                    toggleOptionValue('show', $optValue);
                }

                optId.change(function() {
                    if (parseInt($(this).val()) === 0) {
                        toggleOptionValue('show', $optValue);
                    } else {
                        toggleOptionValue('hide', $optValue);
                    }
                });
            });

            function toggleOptionValue(a, obj) {
                if (a == 'show') {
                    obj.show();
                    obj.find('input').prop('disabled', false);
                } else if (a == 'hide') {
                    obj.hide();
                    obj.find('input').prop('disabled', true);
                }
            }

        })($('#review-form'));
    </script>
@endsection