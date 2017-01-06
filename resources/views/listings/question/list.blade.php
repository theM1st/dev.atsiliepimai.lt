<div class="listing-questions-container">
    <div class="inner-header">
        <h3>{{ trans('common.listing.questions_answers') }}</h3>
    </div>
    <div class="listing-questions" id="listing-questions">
        @foreach ($questions as $q)
            <div class="question">
                <div class="author-picture">
                    <img src="{{ $q->user->getPicture('xs') }}" alt="{{ $q->user->username }}" class="img-circle img-border-grey img-responsive">
                </div>
                <div class="question-text">
                    @if ($q->attributeOption)
                        <div>
                            <span class="badge">{{ $q->attributeOption->option_name }}</span>
                        </div>
                    @endif
                    {{ $q->title }}
                </div>
                <div class="row question-info">
                    <div class="col-sm-6">
                        <p class="question-created"><span>{{ $q->user->username }}</span> parašė klausimą <span>{{ $q->created_at->format('Y.m.d') }}</span></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="question-report">
                            Netinkamas atsiliepimas?
                            <a href="#">Pranešk<span class="fa fa-flag"></span></a>
                        </p>
                    </div>
                </div>
                <div>
                    <a href="#question{{ $q->id }}-answer-form" class="btn btn-third answer-btn">Atsakyti</a>

                    <div class="listing-answer-form" id="question{{ $q->id }}-answer-form">
                        {!! Former::open()->route('answer.store', [$q->id, "#question{$q->id}-answer-form"])->method('post') !!}
                            {!!
                                Former::textarea('title')->label('Jūsų atsakymas')
                            !!}
                            {!! Former::actions()->first_submit('Siųsti atsakymą') !!}
                        {!! Former::close() !!}
                    </div>

                    @if ($q->answers->count() > 0)
                        <div class="question-answers-container">
                            <div class="question-answers">
                                @foreach ($q->answers as $a)
                                    <div class="answer">
                                        <div class="author-picture">
                                            <img src="{{ $a->user->getPicture('xs') }}" alt="{{ $a->user->username }}" class="img-circle img-border-grey img-responsive">
                                        </div>
                                        <div class="answer-text">{{ $a->title }}</div>
                                        <div class="answer-info">
                                            <p class="answer-created"><span>{{ $a->user->username }}</span> atsakė į klausimą <span>{{ $a->created_at->format('Y.m.d') }}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="listing-question-form" id="listing-question-form">
        {!! Former::open()->route('question.store', [$listing->slug, '#listing-question-form'])->method('post') !!}
            {!!
                Former::textarea('title')->label('Jūsų klausimas')
            !!}
            @if ($attribute = $listing->getMainAttribute())
                {!!
                    Former::select('attribute_option_id')
                    ->options(
                        $attribute->options->pluck('option_name', 'id')
                    )
                    ->class('form-control selectpicker')
                    ->title(trans('common.form.select'))
                    ->label($attribute->title)
                !!}
            @endif
            {!! Former::actions()->first_lg_submit('Siųsti klausimą') !!}
        {!! Former::close() !!}
    </div>
</div>

@section('scripts')

    <script>
        $().ready(function(){
            $('.answer-btn').click(function() {
                $('.listing-answer-form').hide();
                $($(this).attr('href')).show();
            });
        });
    </script>
@endsection