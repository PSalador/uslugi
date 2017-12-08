<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
	@if(isset($title))
        <label for="field-{{$name}}">{{$title}}</label>
    @endif
    <select
            @if(isset($prefix))
            name="{{$prefix}}[{{$lang}}]{{$name}}"
            @else
            name="{{$lang}}{{$name}}"
            @endif
            class="form-control {{$class or ''}}" id="field-{{$slug}}">
			
		@if(!isset($values) || is_null($values))
				<option value="0">{{$novalue}}</option>
		@else	
          @foreach($values as $key => $val)
				<option value="{{$key}}">{{$val}}</option>
           @endforeach
		@endif			
    </select>
    @if(isset($help))
        <p class="help-block">{{$help}}</p>
    @endif
</div>
<div class="line line-dashed b-b line-lg"></div>
