@extends('master')

@section('content')

@stop
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			$.ajax({
				url: '/competitor/1/vote',
				data: '',

				dataType: 'json',
				success: function(data)
				{
					console.log(data);
				}
			})
		})
	</script>
@stop