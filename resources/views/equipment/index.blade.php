@extends('layouts.app')

@section('content')
	@include('barcode-modal')
	@include('delete-modal')
	
	<h1 class="ui center aligned icon header">
		<i class="settings icon"></i>
		Equipamentos
	</h1>
	<div class="ui form margin bottom small">
		<div class="fields">
			<div class="three wide field">
				<a class="ui animated fade button green fluid" tabindex="0" href="/equipment/create" data-content="Adicionar um novo equipamento ao sistema" data-variation="wide" data-position="top left">
					<div class="visible content">Novo Equipamento</div>
					<div class="hidden content">
						<i class="icon add"></i>
					</div>
				</a>
			</div>
			<div class="thirteen wide field">
				{!! Form::open(['method'=>'GET', 'action'=>'EquipmentController@index', 'class'=>'ui form']) !!}
					<div class="ui fluid right action left icon input" data-content="Busca por qualquer linha da tabela que contenha os termos de busca" data-variation="very wide" data-position="top right">
						<i class="circular barcode link icon" id="barcodeReader"></i>
						{!! Form::text('query', null, ['placeholder'=>'Buscar equipamentos']) !!}
						{!! Form::button('Buscar', ['type' => 'submit', 'class'=>'ui button teal']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
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
		<div class="ui two column center aligned grid" @if($equipment->lastPage() > 1) data-content="A tabela de equipamentos é paginada de 20 em 20 items. Use o paginador para alterar entre as páginas" data-position="top center" data-variation="flowing" @endif>
			<div class="column">
				{{$equipment->links()}}

			</div>
		</div>
		<table class="ui teal fixed celled table" id="equipmentTable">
			<thead>
				<tr>
					<th class="two wide center aligned">Código</th>
					<th class="two wide center aligned">Nome</th>
					<th class="center aligned eight wide">Descrição</th>
					<th class="center aligned four wide">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($equipment as $equip)
					<tr>
						<td class="center aligned">{{$equip->code}}</td>
						<td class="center aligned">{{$equip->name}}</td>
						<td>{{$equip->description}}</td>
						<td>
							<div class="ui buttons small fluid">
								<a class="ui animated fade button " tabindex="0" href="/equipment/{{$equip->id}}" @if($loop->first) data-content="Visualizar mais detalhes" data-position="left center" @endif>
									<div class="visible content">Ver</div>
									<div class="hidden content">
										<i class="icon search"></i>
									</div>
								</a>
								<a class="ui animated fade button primary" tabindex="0" href="/equipment/{{$equip->id}}/edit" @if($loop->first) data-content="Editar as informações do equipamento" data-variation="wide" data-position="top center" @endif>
									<div class="visible content">Editar</div>
									<div class="hidden content">
										<i class="icon edit"></i>
									</div>
								</a>
								{!! Form::open(['method'=>'DELETE', 'action'=>['EquipmentController@destroy', $equip->id], 'class'=>'ui delete form']) !!}
									{{csrf_field()}}
									<button class="ui animated fade button negative" tabindex="0" type="submit" @if($loop->first) data-content="Remover o equipamento do sistema" data-position="bottom right" @endif>
										<div class="visible content">Deletar</div>
										<div class="hidden content">
											<i class="icon remove"></i>
										</div>
									</button>
								{!! Form::close() !!}
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
			$('table#equipmentTable').on('click', '.delete.form', function(e){
				e.preventDefault();
				var $form=$(this);
				$('.ui.delete.modal').modal({
					closable  : false,
					onDeny    : function(){

					},
					onApprove : function() {
						$form.submit();
					}
				})
				.modal('show');
			});
		});

		$('i#barcodeReader').on('click', function(e){
			$('.ui.barcode.modal').modal('show');
		});

		var pressed = false; 
		var chars = []; 
		$(window).keypress(function(e) {
			if($('.ui.barcode.modal').is(":visible")){
				if (e.which >= 48 && e.which <= 57) {
					chars.push(String.fromCharCode(e.which));
				}
				if (pressed == false) {
					setTimeout(function(){
						if (chars.length >= 10) {
							var barcode = chars.join("");
							$("input[name='query']").val(barcode);
							$('.ui.barcode.modal').modal('hide');
						}
						chars = [];
						pressed = false;
					},500);
				}
				pressed = true;
			}
		});

	</script>
@stop