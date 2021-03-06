{{--
	Template Name: Section Overview
--}}

@extends('layouts.app')

@section('content')

<!-- **************************** -->
<!-- Content with grey background -->
<!-- **************************** -->
<div>
	
	<!-- **************************** -->
	<!-- Bredacrumbs & new navigation -->
	<!-- **************************** -->
	<nav aria-label="Huvudnavigation" class="container background-dark-blue-frida mx-auto nav-boxes-container">
			@include('partials.new_breadcrumbs')
			<h1 class="pl5 pt3 text-white">{{ $post -> post_title }}</h1>
			@include('partials.new_nav-section')
	</nav>
	
	<!-- ************ -->
	<!-- Page content -->
	<!-- ************ -->
	<main>
		<div class="container mx-auto p4" style="background-color: #F0F6FA;">
			<div class="m4">
				@while(have_posts()) @php(the_post())
				<div class="mr6">
					<article>
						@php(the_content())
					</article>
				</div>
				@endwhile
				@if (is_active_sidebar('sidebar-article-bottom'))
					<hr>
					<div class="col-12">
						@include('partials.sidebar-article-bottom')
					</div>
				@endif
			</div>	
		</div>

	</main>

</div>	
@endsection