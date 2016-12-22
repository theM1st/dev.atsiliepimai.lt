{!!
    Former::select('attribute_option_id['.$attribute->id.']')
    ->options(
        $attribute->options->pluck('option_name', 'id')
    )
    ->value(
        ($review->getReviewAttributeOption($attribute->id) ?
            $review->getReviewAttributeOption($attribute->id)->pivot->attribute_option_id : null)
    )
    ->class('form-control selectpicker')
    ->title(trans('common.form.select'))
    ->label($attribute->title)
!!}
@if ($review->getReviewAttributeOption($attribute->id))
    @if ($optionValue = $review->getReviewAttributeOption($attribute->id)->pivot->option_value)
        <div class="attribute-option-value row">
            <div class="col-sm-7">
                {!!
                    Former::text('option_value['.$attribute->id.']')
                        ->value($optionValue)
                        ->label('common.form.review.user_option')
                !!}
            </div>
            <div class="col-sm-5" style="padding-top: 30px;">
                <a href="{{ route('reviews.toggleOption', [$review->id, $attribute->id, 'accept']) }}" class="btn btn-second btn-sm">Patvirtinti</a>
                <a href="{{ route('reviews.toggleOption', [$review->id, $attribute->id, 'cancel']) }}" class="btn btn-red btn-sm">Atmesti</a>
            </div>
        </div>
    @endif
@endif