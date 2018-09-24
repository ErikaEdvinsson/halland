@extends('layouts.app')

@section('content')
<div class="px3 mt4">
	<div class="container mx-auto mt3 mb4">
		<div class="clearfix mxn3 flex flex-wrap content-stretch">
			<div class="col col-12 md-col-9 flex order-1 flex-wrap content-stretch">
				<div class="col col-12 px3">
					<h1 class="mb0">{{ the_title() }}</h1>
					<div class="col col-12 md-col-9">
						{{-- @include('partials.content-utility-bar') --}}
					</div>
				</div>
				<main id="main" class="col col-12 md-col-9 px3">
					@include('partials.content-page')
				</main>
				<div class="col col-12 md-col-3 px3 flex mt3">
					@if (is_active_sidebar('sidebar-right'))
					@include('partials.sidebar-right')
					@endif
					@include('partials.content-nav')
				</div>
			</div>
			<div class="col col-12 md-col-3 mb3 px3 flex flex order-0">
				@include('partials.nav-sidebar')
				@if (is_active_sidebar('sidebar-left'))
				@include('partials.sidebar-left')
				@endif
			</div>
		</div>
	</div>
</div>

@if (have_comments() || comments_open())
@include('partials.comments')
@endif

@endsection
