@if(isset($nav_site))
<nav class="site-nav">
	<div class="site-nav__top">
		<div class="site-nav__container">
			<a href="{{ esc_url( home_url( '/' ) ) }}" class="site-nav__logo" aria-label="Till startsidan">
				<img src="@asset('images/navigation_logo.svg')" alt="">
			</a>
			@if(isset($site_description))
			<span class="site-nav__description">{{ $site_title }}</span>
			@endif
			<button class="site-nav__menu-btn">
				<svg class="icon-badge icon-badge--md">
					<use xlink:href="#menu"/>
				</svg>
			</button>
		</div>
	</div>
	<div class="site-nav__bottom">
		<div class="site-nav__container">
			<ul class="site-nav__list">
				@foreach($nav_site as $topLevelPage)
				<li class="site-nav__item">
					<a href="#" onclick="return false" class="site-nav__link {{ $topLevelPage->active ? 'active' : '' }}">{{ $topLevelPage->title }}</a>
				
					@if(isset($topLevelPage->children))
					<nav class="dropdown">
						<div class="site-nav__container">
							<ul class="dropdown__list">
								@foreach($topLevelPage->children as $childPage)
								<li class="dropdown__item">
									<a href="{{ get_page_link($childPage->ID) }}" class="dropdown__link">{{ $childPage->post_title }}</a>
									<span class="dropdown__link-description"></span>
								</li>
								@endforeach
							</ul>
							<div class="dropdown__close">
								<button class="dropdown__close-btn">
									<svg class="icon-badge">
										<use xlink:href="#x"></use>
									</svg>
								</button>
							</div>
						</div>
					</nav>
					@endif
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="site-nav__overlay"></div>
</nav>
@endif
