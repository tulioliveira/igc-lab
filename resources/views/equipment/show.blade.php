@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised" >
			<div class="ui grid">
				<div class="twelve wide column">
					<h1 class="ui header" data-content="Nome do equipamento" data-position="top left">
						{{$equipment->name}} 
						<div class="ui label" data-content="Código do equipamento" data-position="bottom center">
							<i class="settings icon"></i>Código: {{$equipment->code}}
						</div>
						@if($equipment->isLoaned())
							<div class="ui label red" data-content="Status do equipamento" data-position="right center">
								Emprestado
							</div>
						@else
							<div class="ui label green" data-content="Status do equipamento" data-position="right center">
								Disponível
							</div>
						@endif
					</h1>
				</div>
				<div class="four wide column">
					{!! Form::open(['method'=>'DELETE', 'action'=>['EquipmentController@destroy', $equipment->id], 'class'=>'ui form']) !!}
						{{csrf_field()}}
						<div class="ui buttons right floated">
							<button class="ui animated fade button negative" tabindex="0" type="submit" data-content="Remover o equipamento do sistema" data-position="left center">
								<div class="visible content">Deletar</div>
								<div class="hidden content">
									<i class="icon remove"></i>
								</div>
							</button>
							<a class="ui animated fade button primary" tabindex="0" href="/equipment/{{$equipment->id}}/edit" data-content="Editar as informações do equipamento" data-variation="flowing" data-position="bottom center">
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
			<span class="ui" data-content="Descrição do equipamento" data-position="bottom left">{{$equipment->description}}</span><br/>
			<span><strong>Duração de Empréstimo:</strong> {{$equipment->time}} dias</span>
			<h3 class="ui header"> Empréstimos</h3>
			@if (count($loans) == 0)
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
							<th class="center aligned two wide">Matrícula do Aluno</th>
							<th class="center aligned three wide">Data do Empréstimo</th>
							<th class="center aligned three wide">Data Limite para Devolução</th>
							<th class="center aligned three wide">Data de Devolução</th>
							<th class="center aligned three wide">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach($loans as $loan)
							<tr @if($loan->isLate()) class="error" @endif>
								<td class="center aligned"><a href='/students/{{$loan->student->id}}'>{{$loan->student->enrollment}}</a></td>
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
			Esse equipamento não existe!
		</h2>
		<div class="ui container center aligned">
			<a class="ui primary button" href="/equipment"><i class="icon left arrow"></i>Voltar</a>
		</div>
	@endif
@stop

@section('scripts')

@stop
