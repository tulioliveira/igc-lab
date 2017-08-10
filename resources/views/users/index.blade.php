@extends('layouts.app')

@section('content')
	@include('delete-modal')

	<h1 class="ui center aligned icon header">
		<i class="users icon"></i>
		Usuários
	</h1>
	<div class="ui form margin bottom small">
		<div class="fields">
			<div class="three wide field">
				<a class="ui animated fade button green fluid" tabindex="0" href="/users/create" data-content="Cadastrar um novo usuário no sistema" data-variation="wide" data-position="top left">
					<div class="visible content">Novo Usuário</div>
					<div class="hidden content">
						<i class="icon add"></i>
					</div>
				</a>
			</div>
			<div class="thirteen wide field">
				{!! Form::open(['method'=>'GET', 'action'=>'UsersController@index', 'class'=>'ui form']) !!}
					<div class="ui fluid right action left icon input" data-content="Busca por qualquer linha da tabela que contenha os termos de busca" data-variation="very wide" data-position="top right">
						<i class="search icon"></i>
						{!! Form::text('query', null, ['placeholder'=>'Buscar usuários']) !!}
						{!! Form::button('Buscar', ['type' => 'submit', 'class'=>'ui button teal']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	@if (count($users) == 0)
		<div class="ui icon warning message">
			<i class="huge comments outline icon"></i>
			<div class="content">
				<div class="header">
					Nenhum usuário encontrado
				</div>
			</div>
		</div>
	@else
		<div class="ui two column center aligned grid" @if($users->lastPage() > 1) data-content="A tabela de usuários é paginada de 20 em 20 items. Use o paginador para alterar entre as páginas" data-position="top center" data-variation="flowing" @endif  id="usersTable">
			<div class="column">
				{{$users->links()}}
			</div>
		</div>
		<table class="ui teal fixed celled table">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula</th>
					<th class="center aligned two wide">CPF</th>
					<th class="center aligned two wide">Nome</th>
					<th class="center aligned two wide">Email</th>
					<th class="center aligned four wide">Curso/Setor</th>
					<th class="center aligned four wide">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td class="center aligned">{{$user->enrollment}}</td>
						<td class="center aligned">{{$user->cpf}}</td>
						<td class="center aligned">{{$user->first_name . " " . $user->last_name}}</td>
						<td class="center aligned"><a target="_blank" href="mailto:{{$user->email}}">{{$user->email}}</a></td>
						<td class="center aligned">@if($user->type == "Aluno") {{$user->course}} @else {{$user->department}} @endif</td>
						<td>
							<div class="ui buttons small fluid">
								<a class="ui animated fade button " tabindex="0" href="/users/{{$user->id}}" @if($loop->first) data-content="Visualizar mais detalhes" data-position="left center" @endif>
									<div class="visible content">Ver</div>
									<div class="hidden content">
										<i class="icon search"></i>
									</div>
								</a>
								<a class="ui animated fade button primary" tabindex="0" href="/users/{{$user->id}}/edit" @if($loop->first) data-content="Editar as informações do usuário" data-variation="wide" data-position="top center" @endif>
									<div class="visible content">Editar</div>
									<div class="hidden content">
										<i class="icon edit"></i>
									</div>
								</a>
								{!! Form::open(['method'=>'DELETE', 'action'=>['UsersController@destroy', $user->id], 'class'=>'ui delete form']) !!}
									{{csrf_field()}}
									<button class="ui animated fade button negative" tabindex="0" type="submit" @if($loop->first) data-content="Remover o usuário do sistema" data-position="bottom right" @endif>
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
			$('table#usersTable').on('click', '.delete.form', function(e){
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

			var field = 'page';
			var url = window.location.href;
			if((url.indexOf('?page=') != -1) || (url.indexOf('&page=') != -1))
				$('html, body').animate({scrollTop: $('#usersTable').offset().top}, 500);
		});
	</script>
@stop