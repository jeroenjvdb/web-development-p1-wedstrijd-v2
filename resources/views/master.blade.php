<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{!! Session::token() !!}">
	<title>competition</title>
	{{-- <link rel="stylesheet" href="/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="/css/style.css">
	{{-- <script src="/js/jquery-1.9.1.min.js"></script> --}}
	<link rel="stylesheet" href="/css/foundation.css">
	<link rel="stylesheet" href="/css/normalize.css">
	<script src="/js/vendor/jquery.js"></script>
	@yield('scripts')
</head>
<body>
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1><a href="{{ route('home') }}">Duvel Pics</a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
			@if(Auth::check() && Auth::user()->isAdmin)
			<ul class="left">
				<li class="{{ Request::is('managment') ? 'active' : '' }}"><a href="{{ route('managment') }}">managment</a></li>
			</ul>
			@endif
			<ul class="right">
					@if(Auth::guest())
				<li class="has-dropdown">
			        <a href="#">login</a>
			        {{-- <ul class="dropdown">
			          <li><a href="#">First link in dropdown</a></li>
			          <li class="active"><a href="#">Active link in dropdown</a></li>
			        </ul> --}}
			        <ul class="dropdown" >
			        	<li >
			        		<ul >
						{!! Form::open(array( 'route' => 'login' )) !!}
						<li>{!! Form::label('email') !!}</li>
						<li>{!! Form::text('email') !!}</li>
						<li>{!! Form::label('password') !!}</li>
						<li>{!! Form::password('password') !!}</li>
						<li >{!! Form::submit('login') !!}</li>
						{!! Form::close() !!}
							</ul>
						</li>
						<li ></li>
					</ul>
			    </li>
			    @else
			    	<li><a href="{{ route('logout') }}">logout</a></li>
				@endif
				<li class="{{ Request::is('competition') ? 'active' : '' }}"><a href="{{ route('competition') }}">play now</a></li>
				<li class="{{ Request::is('competition/others') ? 'active' : '' }}"><a href="{{ route('otherCompetitors') }}">other competitors</a></li>
				
			</ul>
		</section>
	</nav>

	

	@if(Auth::check())
		{{ Auth::user()->name }}
		<a href="{{ route('logout') }}">logout</a>
	@endif

	@if($errors)
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	@endif
	<div class="container">
		@yield('content')
	</div>
	
	<script src="/js/vendor/fastclick.js"></script>

	<script src="/js/foundation.min.js"></script>
	<script type="text/javascript">
		$(document).foundation();
	</script>
	@yield('scriptsBottom')
</body>
</html>