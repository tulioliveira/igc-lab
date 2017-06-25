@extends('layouts.app')

@section('content')
	<h1 class="ui center aligned icon header">
		<i class="settings icon"></i>
		Equipamentos
	</h1>
	<div class="ui form margin bottom small">
		<div class="fields">
			<div class="three wide field">
				<a class="ui animated fade button green fluid" tabindex="0" href="/equipment/create">
					<div class="visible content">Novo Equipamento</div>
					<div class="hidden content">
						<i class="icon add"></i>
					</div>
				</a>
			</div>
			<div class="thirteen wide field">
				<div class="ui fluid icon input">
					<input type="text" placeholder="Buscar equipamentos" name="query" id="queryInput">
					<i class="search icon"></i>
				</div>
			</div>
		</div>
	</div>
	@if (empty($equipment))
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
					<th class="eight wide">Descrição</th>
					<th class="four wide">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($equipment as $equip)
					<tr>
						<td class="center aligned">{{$equip->id}}</td>
						<td class="center aligned">{{$equip->name}}</td>
						<td>{{$equip->description}}</td>
						<td>
							<div class="ui buttons small fluid">
								<a class="ui animated fade button " tabindex="0" href="/equipment">
									<div class="visible content">Ver</div>
									<div class="hidden content">
										<i class="icon search"></i>
									</div>
								</a>
								<a class="ui animated fade button primary" tabindex="0" href="/equipment">
									<div class="visible content">Editar</div>
									<div class="hidden content">
										<i class="icon edit"></i>
									</div>
								</a>
								<a class="ui animated fade button negative" tabindex="0" href="/equipment">
									<div class="visible content">Deletar</div>
									<div class="hidden content">
										<i class="icon remove"></i>
									</div>
								</a>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#queryInput').on('keyup', function() {
				var value = $(this).val();
				var patt = new RegExp(value, "i");

				$('table#equipmentTable tbody').find('tr').each(function() {
					if (!($(this).find('td').text().search(patt) >= 0)) {
						$(this).hide();
					}
					if (($(this).find('td').text().search(patt) >= 0)) {
						$(this).show();
					}
				});
			});
		});
	</script>
@stop