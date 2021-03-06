{{--
	Template Name: Section Page
--}}


@extends('layouts.app')

@section('content')
	
	<!-- **************************** -->
	<!-- Content with grey background -->
	<!-- **************************** -->
	<div>
		<nav aria-label="Huvudnavigation" class="container background-dark-blue-frida mx-auto nav-boxes-container z1">
			@include('partials.new_breadcrumbs')
			<h1 class="pl5 pt3 text-white">{{ $post -> post_title }}</h1>
			@include('partials.new_nav-section')
		</nav>
	</div>	
		
	<!-- ********** -->
	<!-- Quick find -->
	<!-- ********** -->
	@if($top_links)
	<nav aria-labelledby="690690" class="" style="background-color: #F0F6FB">
		<div class="container mx-auto mobile-friendly-padding">
			<div class="m0">
				<div class="container mx-auto mobile-friendly-padding">
					<h1 class="h2 pb3" id="690690">Hitta snabbt</h1>
					<div class="flex flex-wrap">	
						@foreach($top_links as $key => $top_link)
							@if($top_link["external_link_toggle"])
								<div class="col-12 lg-col-4 p2">
									<a class="featured-link featured-link--external background-white" href="{{ $top_link["external_link"]["link"] }}" style="color: black; font-weight: bold;">
										<div style="max-width: 90%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $top_link["external_link"]["link_label"] ? $top_link["external_link"]["link_label"] : $top_link["external_link"]["link"]}}</div>
										<svg class="icon-badge featured-link__icon icon-badge--md">
											<use xlink:href="#external-link"/>
										</svg>
									</a>
								</div>
							@else
								<div class="col-12 lg-col-4 p2">
									<a class="featured-link background-white" href="{{ get_permalink($top_link["internal_link"]["link"][0]->ID) }}" style="color: black; font-weight: bold;">
										<div style="max-width: 90%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $top_link["internal_link"]["link_label"] ? $top_link["internal_link"]["link_label"] : $top_link["internal_link"]["link"][0]->post_title }}</div>
										<svg class="featured-link__icon icon-badge icon-badge--md">
											<use xlink:href="#arrow-right"/>
										</svg>
									</a>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</nav>
	@endif

	<!-- **** -->
	<!-- News (Must be fixed) -->
	<!-- **** -->
	<div class="background-white">
		<div class="container mx-auto pl4 pr4 pb1 pt2">
			<div class="m4">
				<div class="pb3 ml3">
					<h1 class="h2">Nyheter {{ $post -> post_title }}</h1>
				</div>
				<div class="container mx-auto">
					<div class="flex flex-wrap">
						@include('partials.new_section-news')
					</div>
				</div>
				<!--
				<span class="ml4">
					<a class="small" href="" style="vertical-align: middle; text-decoration: underline;">Gå till nyhetsarkiv</a>
					<object aria-hidden="true" tabindex="-1" class="pl2" type="image/svg+xml" data="img/icon-navlink.svg" style="vertical-align: middle;"></object>
				</span>
				-->
			</div>
		</div>
	</div>

	<!-- ************ -->
	<!-- Page content -->
	<!-- ************ -->
	<main class="">
		<div class="container mx-auto pt3 pb4 pl4 pr4" style="background-color: #F0F6FB">
			<div class="m5">
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

@endsection