@extends('master')

@section('content')
<div class="row">
	
	<h2>competition</h2>
	{{-- {{ Config::get('constants.test') }} --}}
	<h3>join us</h3>
</div>
	@if(!Auth::check())
	<div class="row">
		<div class="columns medium-12">
			<div class="loginbox loginboxinner loginboxshadow">
				<div class="row">
					<div class="columns medium-3">
			<legend class="right">register</legend>
					</div>
					<div class="columns medium-3 medium-offset-6">
						<p>too lazy?</p>
						<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
				</fb:login-button>

				<div id="status">
					</div>
				</div>
				{!! Form::open(['url' => '/register', 'data-abide' => '']) !!}
			<div class="row">
				<div class="columns medium-12">
					{!! Form::label('email', 'email adress') !!}
					{!! Form::text('email', '', ['placeholder' => 'example@gmail.com', 'autofocus', 'required' => '', 'pattern' => 'email']) !!}
					<small class="error">you have to fill in an email adress</small>
				</div>
			</div>	
			<div class="row">
				<div class="columns medium-6">
						{!! Form::label('password', 'password') !!}
						{!! Form::password('password', ['required' => '']	) !!}
						<small class="error">must be at least 8 characters long</small>
				</div>
				<div class="columns medium-6">
						{!! Form::label('password_confirmation', 'confirm password') !!}
						{!! Form::password('password_confirmation', ['required' => '']) !!}
						<small class="error">the 2 input fields must be the same</small>
				</div>
			</div>
			<div class="row">
				<div class="columns medium-5">
						{!! Form::label('surname', 'surname') !!}
						{!! Form::text('surname', '', ['required' => '']) !!}
						<small class="error">this field is required</small>
					</div>
				<div class="columns medium-7">
						{!! Form::label('name', 'name') !!}
						{!! Form::text('name', '', ['required' => '']) !!}
						<small class="error">this field is required</small>
				</div>
			</div>
			<div class="row">
				<div class="columns medium-5">
						{!! Form::label('dateOfBirth', 'date of birth') !!}
						{!! Form::date('dateOfBirth', '', ['required' => ''] ) !!}	
						<small class="error">this field is required</small>
				</div>
				<div class="columns medium-7">
						{!! Form::label('residence', 'woonplaats') !!}
						{!! Form::text('residence', '', ['required' => '']) !!}
						<small class="error">this field is required</small>
						{!! Form::label('address', 'adres') !!}
						{!! Form::text('address', '', ['required' => '']) !!}
						<small class="error">this field is required</small>
						{!! Form::label('housenumber') !!}
						{!! Form::text('housenumber', '', ['required' => '']) !!}
						<small class="error">this field is required</small>
				</div>
			</div>
			<div class="row">
				<div class="form-group text-center centerbuttons col-md-12">
					{!! Form::submit('register', array('class' => 'btn btn-success btn-login-submit btn-radius center')) !!}
				</div>
			</div>
					{!! Form::close() !!}
			
				

			</div>
		</div>
	</div>
	@endif
		
	@if(Auth::check())
	<div class="row">
		<div class="columns medium-6">
			
			{!!  Form::open(array('route' => 'competition' ,'files' => true)) !!}
			<div>
				{!! Form::file('duvel', array('id' => 'duvel', 'class' => 'custom-file-input')) !!} <br>
				
			</div>
				
				{!! Form::submit() !!}
			{!! Form::close() !!}
		</div>
		<div class="columns medium-6">
			<img src="" alt="" class="invisible" id="uploadImg">
		</div>
		<script src="js/showPic.js"></script>
	</div>
	@endif

	
@stop

@section('scriptsBottom')
	<script src="/js/facebook-login.js" type="text/javascript"></script>
	

@stop