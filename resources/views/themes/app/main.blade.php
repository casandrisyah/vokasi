@php
$themes = \App\Models\Appearance\Theme::where('is_admin',true)->where('is_active',true)->first();
// dd($themes);
$logo = \App\Models\Setting\Config::where('key','APP_LOGO')->first();
// $layout = $themes->layout->where('type','office_layout')->where('is_active',true)->first();
@endphp
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.8
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	@include('themes.app.head')
	<!--end::Head-->
	@guest
	<body id="kt_body" class="app-blank">
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid" id="cms_app">
				{{$slot}}
                {{-- @if (!request()->is('auth'))
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url('https://cdn.yadaekidanta.com/keenthemes/metronic8/1/media/misc/auth-bg.png')">
					<div class="div-cover d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<a href="../../demo1/dist/index.html" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{ asset('web/images/logodel.png') }}" class="h-60px h-lg-75px" />
						</a>
						<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="https://cdn.yadaekidanta.com/keenthemes/metronic8/1/media/misc/auth-screens.png" alt="" />
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
						<div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
						<br />and provides some background information about
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
						<br />work following this is a transcript of the interview.</div>
					</div>
				</div>
                @endif --}}
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<div class="position-fixed top-0 end-0 p-3 z-index-3">
			<div id="notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<span class="svg-icon svg-icon-2 svg-icon-primary me-3">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="currentColor"></path>
							<path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="currentColor"></path>
						</svg>
					</span>
					<strong class="me-auto">{{config('app.name')}}</strong>
					<small>Just now</small>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body" id="toast_body"></div>
			</div>
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		@include('themes.app.js')
		@yield('custom_js')
		<!--end::Javascript-->
	@endguest
	@auth
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="false" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				@include('themes.app.header')
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					@include('themes.app.sidebar')
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid" id="cms_app">
							{{$slot}}
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						@include('themes.app.footer')
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->

		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->

		<!--end::Chat drawer-->
		<!--begin::Cart drawer-->

		<!--end::Cart drawer-->
		<!--end::Drawers-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->
		<!--end::Modals-->
		<div class="position-fixed mt-20 top-0 end-0 p-3 z-index-3">
			<div id="notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<span class="svg-icon svg-icon-2 svg-icon-primary me-3">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="currentColor"></path>
							<path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="currentColor"></path>
						</svg>
					</span>
					<strong class="me-auto">{{config('app.name')}}</strong>
					<small>Just now</small>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body" id="toast_body"></div>
			</div>
		</div>
		<!--begin::Javascript-->
		@include('themes.app.js')
		@yield('custom_js')
		<!--end::Javascript-->
	@endauth
	<!--end::Body-->
	</body>
</html>
