@extends('layouts.app')

@section('content')
<div class="ui segment container raised">
	<h2 class="ui center aligned icon header">
		<i class="world icon"></i>
		Laboratório de Topografia do Departamento de Cartografia do IGC
	</h2>
	
	<div class="ui dividing header" data-content="Exibe os últimos 5 empréstimos realizados" data-position="top left" data-variation="wide">Últimos Empréstimos</div>
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
		<table class="ui teal fixed celled table" id="loansTable" data-content="Empréstimos em atraso serão exibidos em vermelho" data-position="top right" data-variation="wide">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula do Aluno</th>
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
						<td class="center aligned"><a href='/students/{{$loan->student->id}}'>{{$loan->student->enrollment}}</a></td>
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
	
	<div class="ui dividing header" data-content="Exibe os últimos 20 equipamentos mais requisitados" data-position="top left" data-variation="flowing">Equipamentos Mais Requisitados</div>
	@if (count($equipment) == 0)
		<div class="ui icon warning message">
			<i class="huge comments outline icon"></i>
			<div class="content">
				<div class="header">
					Nenhum equipamento encontrado
				</div>
			</div>
		</div>
	@else
		<table class="ui teal fixed celled table" id="equipmentTable">
			<thead>
				<tr>
					<th class="two wide center aligned">Código</th>
					<th class="two wide center aligned">Nome</th>
					<th class="center aligned eight wide">Descrição</th>
					<th class="center aligned four wide">Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach($equipment as $equip)
					<tr>
						<td class="center aligned">{{$equip->code}}</td>
						<td class="center aligned">{{$equip->name}}</td>
						<td>{{$equip->description}}</td>
						<td class="center aligned">
							@if($equip->isLoaned())
								<div class="ui label red">
									Emprestado
								</div>
							@else
								<div class="ui label green">
									Disponível
								</div>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</div>
@stop