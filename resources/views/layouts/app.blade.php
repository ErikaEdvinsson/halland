<!doctype html>
<html @php(language_attributes())>
	@include('partials.head')
	<body @php(body_class())>
		@include('partials.cookie-notice')
		@include('partials.site-notices')
		@php(do_action('get_header'))
		@include('partials.header')
		@include('partials.dropdown')
		@yield('content')
		@php(do_action('get_footer'))
		@include('partials.footer')
		@php(wp_footer())
	</body>
</html>