@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised">
			<h1 class="ui header">{{$equipment->name}}</h1>
			aaa
			
		</div>
	@else
		<h1>aaaaaaTODO</h1>
	@endif
@stop

@section('scripts')

@stop
