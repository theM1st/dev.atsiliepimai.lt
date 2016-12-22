@extends('layouts.app')

@section('title', getTitle($title))

@section('content')
    <div class="container">
        <div class="admin-block review-edit">
            {!! adminHeaderTitle() !!}

            <div class="admin-body">
                <div class="row">
                    <div class="col-md-8">
                        {!! Former::open()->route('reviews.update', $review->id)->method('put')->id('review-form') !!}

                            {!!
                                Former::text('rating')
                                    ->label(trans('common.form.review.rating', ['name' => 'produktą/paslaugą']))
                            !!}

                            {!!
                                Former::text('review_title')->label('common.form.review.title')
                                    ->placeholder('common.form.review.title_placeholder')
                                    ->help('common.form.review.title_help')
                            !!}

                            @if ($review->mainAttribute)
                                @include('admin.reviews.form.attribute_option', ['attribute' => $review->mainAttribute])
{{--
                                {!!
                                    Former::select('option_id['.$review->mainAttribute->id.']')
                                    ->options(
                                        $review->mainAttribute->options->pluck('option_name', 'id')->put(0, trans('common.form.review.cannot_find_my_option'))
                                    )
                                    ->class('form-control selectpicker')
                                    ->title(trans('common.form.select'))
                                    ->label($review->mainAttribute->title)
                                !!}
--}}
{{--
                                <div class="attribute-option-value" style="display: none">
                                {!!
                                    Former::text('option_value['.$review->mainAttribute->id.']')
                                        ->disabled()
                                        ->label('common.form.review.write_your_option')
                                !!}
                                </div>
--}}
                            @endif

                            {!!
                                Former::textarea('review_description')
                                    ->rows(4)
                                    ->placeholder('common.form.review.description_placeholder')
                                    ->label('common.form.review.description')
                                    ->help('common.form.review.description_help')
                            !!}

                            @if ($attributes = $review->secondaryAttributes)
                                @foreach ($attributes as $attribute)
                                    @include('admin.reviews.form.attribute_option', ['attribute' => $attribute])
                                @endforeach
                            @endif

                            <div class="checkbox-container">
                                {!! Former::checkbox('active')->class('icheck')->text('common.form.review.active') !!}
                            </div>

                            <hr>
                            {!! Former::actions()->first_lg_submit('common.update') !!}

                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('css/star-rating/star-rating.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('js/star-rating.js') }}"></script>

    <script>
        starRating($(".review-edit #rating"), { size: 'md' });

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