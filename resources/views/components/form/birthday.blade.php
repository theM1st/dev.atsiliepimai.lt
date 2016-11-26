<div class="form-group">
    <label class="control-label" for="birthday">{{ trans('common.user.birthday') }}</label>
    <div>
        {!!
            Form::select('year',
            collect(array_combine($range = range((date('Y')-6), (date('Y')-100)), $range)),
            ($value ? $value->format('Y') : null),
            ['class' => 'form-control selectpicker birth-year', 'title' => 'Metai'])
        !!}
        -
        {!!
            Form::select('month',
            [1, 2, 3, 4, 5, 6 ,7 ,8, 9, 10, 11, 12],
            ($value ? $value->format('m') : null),
            ['class' => 'form-control selectpicker birth-month', 'title' => 'Mėnuo'])
        !!}
        -
        {!!
            Form::select('day',
            array_combine($range = range(1, 31), $range),
            ($value ? $value->format('d') : null),
            ['class' => 'form-control selectpicker birth-day', 'title' => 'Diena'])
        !!}
    </div>
</div>