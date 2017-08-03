@extends('layouts.app')

@section('content')
	@if (isset($user))
		<div class="ui segment raised" >
			<div class="ui grid">
				<div class="twelve wide column">
					<h1 class="ui header" data-content="Nome do usuário" data-position="top left">
						{{$user->first_name . " " . $user->last_name}} 
						<div class="ui label violet">
							@if($user->type == "Aluno") Aluno @else Servidor @endif
						</div>
						<div class="ui label" data-content="Matrícula do usuário" data-position="right center">
							<i class="user icon"></i> Matrícula: {{$user->enrollment}}
						</div>
					</h1>
				</div>
				<div class="four wide column">
					{!! Form::open(['method'=>'DELETE', 'action'=>['UsersController@destroy', $user->id], 'class'=>'ui form']) !!}
						{{csrf_field()}}
						<div class="ui buttons right floated">
							<button class="ui animated fade button negative" tabindex="0" type="submit" data-content="Remover o usuário do sistema" data-position="left center">
								<div class="visible content">Deletar</div>
								<div class="hidden content">
									<i class="icon remove"></i>
								</div>
							</button>
							<a class="ui animated fade button primary" tabindex="0" href="/users/{{$user->id}}/edit" data-content="Editar as informações do usuário" data-variation="flowing" data-position="bottom center">
								<div class="visible content">Editar</div>
								<div class="hidden content">
									<i class="icon edit"></i>
								</div>
							</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="ui divider"></div>
			<div class="ui center aligned container">
				<div class="ui large horizontal list">
					<div class="top aligned item">
						<div class="header"><i class="id card icon"></i>CPF</div>
						{{$user->cpf}}
					</div>
					<div class="top aligned item">
						<div class="header"><i class="mail icon"></i>E-mail</div>
						<a target="_blank" href="mailto:{{$user->email}}">{{$user->email}}</a>
					</div>
					@if($user->type == "Aluno")
						<div class="top aligned item">
							<div class="header"><i class="book icon"></i>Curso</div>
							{{$user->course}}
						</div>
					@else
						<div class="top aligned item">
							<div class="header"><i class="book icon"></i>Departamento/Setor</div>
							{{$user->department}}
						</div>
					@endif
				</div>
			</div>
			<h3 class="ui header"> Empréstimos</h3>
			@if (count($user->loans) == 0)
				<div class="ui icon warning message">
					<i class="huge comments outline icon"></i>
					<div class="content">
						<div class="header">
							Nenhum empréstimo encontrado
						</div>
					</div>
				</div>
			@else
				<div class="ui two column center aligned grid" @if($loans->lastPage() > 1) data-content="A tabela de empréstimos é paginada de 20 em 20 items. Use o paginador para alterar entre as páginas" data-position="top center" data-variation="flowing" @endif>
					<div class="column">
						{{$loans->links()}}
					</div>
				</div>
				<table class="ui teal fixed celled table" id="loansTable">
					<thead>
						<tr>
							<th class="center aligned two wide">Código do Equipamento</th>
							<th class="center aligned three wide">Data do Empréstimo</th>
							<th class="center aligned three wide">Data Limite para Devolução</th>
							<th class="center aligned three wide">Data de Devolução</th>
							<th class="center aligned three wide">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach($loans as $loan)
							<tr @if($loan->isLate()) class="error" @endif>
								<td class="center aligned"><a href='/equipment/{{$loan->equipment->id}}'>{{$loan->equipment->code}}</a></td>
								<td class="center aligned">{{$loan->loaned_on->format('d/m/Y H:i:s')}}</td>
								<td class="center aligned">{{$loan->deadline->format('d/m/Y H:i:s')}}</td>
								<td class="center aligned">{{$loan->returned_on ? $loan->returned_on->format('d/m/Y H:i:s') : ''}}</td>
								<td class="center aligned">{{$loan->status()}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	@else
		<h1 class="ui center red aligned icon header">
			<i class="remove circle red icon"></i>
			Erro
		</h1>
		<h2 class="ui center aligned header">
			Esse usuário não existe!
		</h2>
		<div class="ui container center aligned">
			<a class="ui primary button" href="/users"><i class="icon left arrow"></i>Voltar</a>
		</div>
	@endif
@stop

@section('scripts')

@stop
