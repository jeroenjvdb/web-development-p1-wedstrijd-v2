@extends('master')

@section('content')
	<h1>managment</h1>
	<div><a href="{{ route('exportAll') }}">export</a></div>
	
	@foreach($competitors as $competitor)
		<div class="row managmentItem">
			<div class="{{ $competitor->is_deleted ? 'deleted' : '' }}"></div>
			<div class="columns medium-3 managment"><div><p><img src="{{ $competitor->thumbnail }}" alt="{{ $competitor->user->fullName() }}"></p></div></div>
			<div class="columns medium-6 managment"><div><p>{!! $competitor->user->NAW() !!}</p>
			<p>{{ $competitor->user->email }}</p></div></div>
			<div class="columns medium-2 managment"><div><p>{{ $competitor->created_at }}</p></div></p></div>
			<div class="columns medium-1 managment">
				
						<p><a href="{{ route('deleteCompetitor', [$competitor->id]) }}"><img src="/img/delete.png" alt=""></a></p>
					
			</div>
		</div>
		<hr>

	@endforeach
	{!! $competitors->render() !!}
	
@stop