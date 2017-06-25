@extends('layouts.app')

@section('content')
	<form class="ui form">
		
	</form>
	<div class="ui cards">
		@forelse($equipment as $equip)
			<div class="card">
				<div class="content">
					<div class="header">
						{{$equip->name}}
					</div>
					<div class="meta">
						{{$equip->id}}
					</div>
					<div class="description">
						{{$equip->description}}
					</div>
				</div>
				<div class="extra content">
					<div class="ui two buttons">
						<div class="ui button">Editar</div>
						<div class="ui red button">Deletar</div>
					</div>
				</div>
			</div>
		@empty
		    <div class="ui huge header center aligned">Nenhum equipamento encontrado</div>
		@endforelse
	</div>
@stop
