@extends('layout.front')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2" style="min-height: 300px">
		<h2 class="text-center text-{{ $data['class'] }}">{{ $data['message'] }}</h2>
	</div>
</div>
@endsection