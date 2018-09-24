<!doctype html>
<html @php(language_attributes())>
	@include('partials.head')
	<body @php(body_class()) style="display: flex; min-height: 100vh; flex-direction: column;">
		<div class="flex-auto">
		@include('partials.jump-to-content')
		@include('partials.cookie-notice')
		@include('partials.site-notices')

		@include('partials.header')
		@hasSection ('subheader')
			<div class="background-gradient-blue py3 px2">
				<div class="container mx-auto">
					<div class="clearfix mxn2">
						@yield('subheader')
					</div>
				</div>
			</div>
		@endif

		@yield('content')
		</div>
		@include('partials.footer')
	</body>
</html>
