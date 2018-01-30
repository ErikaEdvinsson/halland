@if (isset($notices) && !empty($notices))
	@foreach ($notices as $notice)
		<div class="notice">
			<p class="notice__text">{!! $notice['notice_message'] !!}</p>
			<button class="notice__button">{!! $notice['notice_button'] !!}</button>
		</div>
	@endforeach
@endif
