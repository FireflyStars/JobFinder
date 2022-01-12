<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{ env('APP_NAME') }} - @yield('title')</title>

		<meta name="description" content="" />
		<meta name="author" content="{{ env('APP_NAME') }}">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        @include('layouts.admin.stylelib')
        @include('layouts.admin.jslib')

	</head>

	<body class="no-skin">
		@include('layouts.admin.navbar')

		<div class="main-container ace-save-state" id="main-container">
			@include('layouts.admin.sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li class="active"> @yield('content_header') </li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								@if(session()->has('message'))
									<div class="alert
									<?php if(session()->has('alert_tag')) : ?>
										{{ session('alert_tag') }}
									<?php else : ?>
										alert-success
									 <?php endif ?>
									" style="margin-bottom: 5px">
										{{ session('message') }}
									</div>
								@endif
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>
			<!-- /.main-content -->

		</div>

		<!-- /.main-container -->
	</body>
</html>