@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised">
			<h1 class="ui header">
				{{$equipment->name}} 
				<div class="ui label">
					<i class="settings icon"></i> Id:{{$equipment->id}}
				</div>
			</h1>
			{{$equipment->description}}
			
		</div>
	@else
		<h1>aaaaaaTODO</h1>
	@endif
@stop

@section('scripts')

@stop
