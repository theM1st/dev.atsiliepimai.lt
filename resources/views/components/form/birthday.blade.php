{!!
    Form::select('year',
    collect(array_combine($range = range((date('Y')-6), (date('Y')-100)), $range))->prepend('', ''),
    ($value ? $value->format('Y') : null),
    ['class' => 'form-control birth-year'])
!!}
-
{!!
    Form::select('month',
    ['', 1, 2, 3, 4, 5, 6 ,7 ,8, 9, 10, 11, 12],
    ($value ? $value->format('m') : null),
    ['class' => 'form-control birth-month'])
!!}
-
{!!
    Form::select('day',
    collect(array_combine($range = range(1, 31), $range))->prepend('', ''),
    ($value ? $value->format('d') : null),
    ['class' => 'form-control birth-day'])
!!}