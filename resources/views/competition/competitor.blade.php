@extends('master')

@section('content')
	<img src="{{ $competitor->picture_url }}" alt="">
	<a href="{{ route('vote', [$competitor->id]) }}">vote now!</a>
@stop