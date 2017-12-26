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
			
		@if(!isset($value) || is_null($value))
				<option value="0">{{$novalue}}</option>
		@else	
          @foreach($value as $key => $val)
			@if(isset($value['default']))
			  @if($key!='default')
				<option 
					@if($value['default']==$key)
						selected
					@endif
				value="{{$key}}">{{$val}}</option>
			  @endif
			@else
				<option value="{{$key}}">{{$val}}</option>
			@endif
           @endforeach
		@endif			
    </select>
    @if(isset($help))
        <p class="help-block">{{$help}}</p>
    @endif
</div>
<div class="line line-dashed b-b line-lg"></div>
