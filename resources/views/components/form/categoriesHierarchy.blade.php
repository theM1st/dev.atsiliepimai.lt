<div class="form-group{{ ($errors->has($name) ? ' has-error': '') }}">
    <label class="control-label" for="{{ $name }}">{{ trans('common.form.listing.select_category') }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control selectpicker" title="{{ trans('common.form.listing.suitable_category') }}" data-live-search="true">
        @foreach($categories as $node)
            {!! categoriesHierarchyOptions($node, $value) !!}
        @endforeach
    </select>
    @if ($errors->has($name))
        <span class="help-block">{{ $errors->get('category_id')[0] }}</span>
    @endif
</div>