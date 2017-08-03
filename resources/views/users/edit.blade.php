@extends('layouts.app')

@section('content')
	@if (isset($user))
		@if($errors->any())
			<div class="ui error message">
				<i class="close icon"></i>
				<div class="header">
					O formulário de edição apresentou os seguintes erros:
				</div>
				<ul class="list">
					@foreach($errors->all() as $message)
						<li>{{$message}}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="ui segment raised">
			{!! Form::model($user, ['method'=>'PATCH', 'action'=>['UsersController@update', $user->id], 'class'=>'ui form']) !!}
				{{csrf_field()}}
				<h2 class="ui dividing header">Editar {{$user->type}}</h2>
				<div class="fields">
					<div class="four wide required field {{ $errors->has('enrollment') ? 'error' : '' }}">
						{!! Form::label('enrollment', 'Matrícula') !!}
						{!! Form::text('enrollment', null) !!}
					</div>
					<div class="four wide required field {{ $errors->has('cpf') ? 'error' : '' }}">
						{!! Form::label('cpf', 'CPF') !!}
						{!! Form::text('cpf', null, ['placeholder'=>'CPF do Usuário','data-mask'=>'000.000.000-00']) !!}
					</div>
					<div class="four wide required field {{ $errors->has('first_name') ? 'error' : '' }}">
						{!! Form::label('first_name', 'Nome') !!}
						{!! Form::text('first_name', null, ['placeholder'=>'Nome do Usuário']) !!}
					</div>
					<div class="four wide required field {{ $errors->has('last_name') ? 'error' : '' }}">
						{!! Form::label('last_name', 'Sobrenome') !!}
						{!! Form::text('last_name', null, ['placeholder'=>'Sobrenome do Usuário']) !!}
					</div>
				</div>
				<div class="fields">
					<div class="six wide required field {{ $errors->has('email') ? 'error' : '' }}">
						{!! Form::label('email', 'E-mail') !!}
						{!! Form::email('email', null, ['placeholder'=>'E-mail do Usuário']) !!}
					</div>
					@if($user->type == "Aluno")
						<div class="eight wide required field {{ $errors->has('course') ? 'error' : '' }}">
							{!! Form::label('course', 'Curso') !!}
							{!! Form::select('course', ['' => 'Curso', "Administração"=>"Administração", "Administração - Montes Claros"=>"Administração - Montes Claros", "Agronomia - Montes Claros"=>"Agronomia - Montes Claros", "Antropologia"=>"Antropologia", "Aquacultura"=>"Aquacultura", "Arquitetura e Urbanismo"=>"Arquitetura e Urbanismo", "Arquivologia"=>"Arquivologia", "Artes Visuais"=>"Artes Visuais", "Biblioteconomia"=>"Biblioteconomia", "Biomedicina"=>"Biomedicina", "Ciência da Computação"=>"Ciência da Computação", "Ciências Atuariais"=>"Ciências Atuariais", "Ciências Biológicas"=>"Ciências Biológicas", "Ciências Contábeis"=>"Ciências Contábeis", "Ciências do Estado"=>"Ciências do Estado", "Ciências Econômicas"=>"Ciências Econômicas", "Ciências Sociais"=>"Ciências Sociais", "Ciências Socioambientais"=>"Ciências Socioambientais", "Cinema de Animação e Artes Digitais"=>"Cinema de Animação e Artes Digitais", "Comunicação Social"=>"Comunicação Social", "Conservação e Restauração de Bens Culturais Móveis"=>"Conservação e Restauração de Bens Culturais Móveis", "Controladoria e Finanças"=>"Controladoria e Finanças", "Curso Superior de Tecnologia em Radiologia"=>"Curso Superior de Tecnologia em Radiologia", "Dança"=>"Dança", "Design"=>"Design", "Design de Moda"=>"Design de Moda", "Direito"=>"Direito", "Educação Básica Indígena: Formação Intercultural de Professor - FIEI"=>"Educação Básica Indígena: Formação Intercultural de Professor - FIEI", "Educação Física"=>"Educação Física", "Enfermagem"=>"Enfermagem", "Engenharia Aeroespacial"=>"Engenharia Aeroespacial", "Engenharia Agrícola e Ambiental"=>"Engenharia Agrícola e Ambiental", "Engenharia Ambiental"=>"Engenharia Ambiental", "Engenharia Civil"=>"Engenharia Civil", "Engenharia de Alimentos - Montes Claros"=>"Engenharia de Alimentos - Montes Claros", "Engenharia de Controle e Automação"=>"Engenharia de Controle e Automação", "Engenharia de Minas"=>"Engenharia de Minas", "Engenharia de Produção"=>"Engenharia de Produção", "Engenharia de Sistemas"=>"Engenharia de Sistemas", "Engenharia Elétrica"=>"Engenharia Elétrica", "Engenharia Florestal"=>"Engenharia Florestal", "Engenharia Mecânica"=>"Engenharia Mecânica", "Engenharia Metalúrgica"=>"Engenharia Metalúrgica", "Engenharia Química"=>"Engenharia Química", "Estatística"=>"Estatística", "Farmácia"=>"Farmácia", "Filosofia"=>"Filosofia", "Física"=>"Física", "Fisioterapia"=>"Fisioterapia", "Fonoaudiologia"=>"Fonoaudiologia", "Geografia"=>"Geografia", "Geologia"=>"Geologia", "Gestão de Serviços de Saúde"=>"Gestão de Serviços de Saúde", "Gestão Pública"=>"Gestão Pública", "História"=>"História", "Letras"=>"Letras", "Licenciatura em Educação do Campo"=>"Licenciatura em Educação do Campo", "Licenciatura Intercultural Indígena"=>"Licenciatura Intercultural Indígena", "Matemática"=>"Matemática", "Matemática Computacional"=>"Matemática Computacional", "Medicina"=>"Medicina", "Medicina Veterinária"=>"Medicina Veterinária", "Museologia"=>"Museologia", "Música"=>"Música", "Nutrição"=>"Nutrição", "Odontologia"=>"Odontologia", "Pedagogia"=>"Pedagogia", "Psicologia"=>"Psicologia", "Química"=>"Química", "Química Tecnológica"=>"Química Tecnológica", "Relações Econômicas Internacionais"=>"Relações Econômicas Internacionais", "Sistemas de Informação"=>"Sistemas de Informação", "Teatro (Artes Cênicas)"=>"Teatro (Artes Cênicas)", "Terapia Ocupacional"=>"Terapia Ocupacional", "Turismo"=>"Turismo", "Zootecnia - Montes Claros"=>"Zootecnia - Montes Claros"], null, ['class'=>'ui search dropdown']) !!}
						</div>
					@else
						<div class="eight wide required field {{ $errors->has('department') ? 'error' : '' }}">
							{!! Form::label('department', 'Departamento/Setor') !!}
							{!! Form::text('department', null, ['placeholder'=>'Departamento/Setor do Servidor']) !!}
						</div>
					@endif
				</div>
				<div class="ui buttons fluid">
					<a class="ui button" href="/users">Cancelar</a>
					<div class="or" data-text="ou"></div>
					{!! Form::submit('Salvar', ['class'=>'ui positive button']) !!}
				</div>
			{!! Form::close() !!}
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
	<script type="text/javascript">
		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});

		$(document).ready(function (){
			$('.ui.dropdown').dropdown();

			@if($user->type == "Aluno")
				$('#enrollment').attr("placeholder", "Matrícula do Aluno");
				$('#enrollment').mask("0000000000");
			@else
				$('#enrollment').attr("placeholder", "Matrícula do Servidor");
				$('#enrollment').mask("000000-0");
			@endif
		});
	</script>
@stop