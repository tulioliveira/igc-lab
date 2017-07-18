@extends('layouts.app')

@section('content')
	@if (isset($student))
		<div class="ui segment raised" >
			<div class="ui grid">
				<div class="twelve wide column">
					<h1 class="ui header" data-content="Nome do aluno" data-position="top left">
						{{$student->name}} 
						<div class="ui label" data-content="Matrícula do aluno" data-position="right center">
							<i class="student icon"></i> Matrícula: {{$student->enrollment}}
						</div>
					</h1>
				</div>
				<div class="four wide column">
					{!! Form::open(['method'=>'DELETE', 'action'=>['StudentsController@destroy', $student->id], 'class'=>'ui form']) !!}
						{{csrf_field()}}
						<div class="ui buttons right floated">
							<button class="ui animated fade button negative" tabindex="0" type="submit" data-content="Remover o aluno do sistema" data-position="left center">
								<div class="visible content">Deletar</div>
								<div class="hidden content">
									<i class="icon remove"></i>
								</div>
							</button>
							<a class="ui animated fade button primary" tabindex="0" href="/students/{{$student->id}}/edit" data-content="Editar as informações do aluno" data-variation="flowing" data-position="bottom center">
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
						{{$student->cpf}}
					</div>
					<div class="top aligned item">
						<div class="header"><i class="mail icon"></i>E-mail</div>
						<a href="mailto:{{$student->email}}">{{$student->email}}</a>
					</div>
					<div class="top aligned item">
						<div class="header"><i class="book icon"></i>Curso</div>
						{{$student->course}}
					</div>
					<div class="top aligned item">
						<div class="header"><i class="home icon"></i>Endereço & Contato</div>
						<div class="content address">
							{{$student->street}}, {{$student->number}} @if($student->complement) - {{$student->complement}} @endif <br>
							{{$student->city}} - {{$student->state}}, {{$student->zipcode}} <br>
							Celular: {{$student->phone}}
						</div>
					</div>
				</div>
			</div>

		</div>
	@else
		<h1 class="ui center red aligned icon header">
			<i class="remove circle red icon"></i>
			Erro
		</h1>
		<h2 class="ui center aligned header">
			Esse aluno não existe!
		</h2>
		<div class="ui container center aligned">
			<a class="ui primary button" href="/students"><i class="icon left arrow"></i>Voltar</a>
		</div>
	@endif
@stop

@section('scripts')

@stop
