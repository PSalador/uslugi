<div class="bg-white">
	<div class="wrapper-md">
		<div class="row">
		{{-- dd($forms) --}}
		 @foreach($forms as $key => $form)
			<div class="col">
				{!! $form?? '' !!}
			</div>
		 @endforeach
		</div>
	</div>	
</div>
