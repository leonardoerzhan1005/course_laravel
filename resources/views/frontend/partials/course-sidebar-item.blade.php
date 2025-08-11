@if(count($specializations) > 0)
<div class="courses-widget mb-4 pb-1">
    <h4 class="widget-title">{{ __('Специализации') }}</h4>
<div class="courses-cat-list">
    <ul class="list-wrap">
        @foreach ($specializations->sortBy('sort_order') as $specialization)
        <li>
            <div class="form-check">
                <input @checked(in_array($specialization->id, $selectedSpecializations)) class="form-check-input category-checkbox" type="checkbox" value="{{ $specialization->id }}" id="spec_{{ $specialization->id }}">
                <label class="form-check-label" for="spec_{{ $specialization->id }}">{{ $specialization->name_ru }}</label>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="show-more">
    </div>
</div>
 </div>
@endif