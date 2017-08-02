@extends('layouts.app')

@section('content')
	@if($errors->any())
		<div class="ui error message">
			<i class="close icon"></i>
			<div class="header">
				O formulário de criação apresentou os seguintes erros:
			</div>
			<ul class="list">
				@foreach($errors->all() as $message)
					<li>{{$message}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="ui segment raised">
		{!! Form::open(['method'=>'POST', 'action'=>'UsersController@store', 'class'=>'ui form']) !!}
			{{csrf_field()}}
			<h2 class="ui dividing header">Cadastrar Usuário</h2>
			<div class="inline fields">
				<div class="field">
					<div class="ui radio checkbox">
						{!! Form::radio('type', 'Aluno', true) !!}
						{!! Form::label('type', 'Aluno') !!}
					</div>
				</div>
				<div class="field">
					<div class="ui radio checkbox">
						{!! Form::radio('type', 'Servidor') !!}
						{!! Form::label('type', 'Servidor') !!}
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="four wide required field {{ $errors->has('enrollment') ? 'error' : '' }}">
					{!! Form::label('enrollment', 'Matrícula') !!}
					{!! Form::text('enrollment', null, ['placeholder'=>'Matrícula do Aluno','data-mask'=>'0000000000']) !!}
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
				<div class="eight wide required field {{ $errors->has('department') ? 'error' : '' }}" style="display: none;">
					{!! Form::label('department', 'Departamento ou Setor') !!}
					{!! Form::text('department', null, ['placeholder'=>'Departamento ou Setor do Servidor']) !!}
				</div>
				<div class="eight wide required field {{ $errors->has('course') ? 'error' : '' }}">
					{!! Form::label('course', 'Curso') !!}
					{!! Form::select('course', ["Administração"=>"Administração", "Administração - Montes Claros"=>"Administração - Montes Claros", "Agronomia - Montes Claros"=>"Agronomia - Montes Claros", "Antropologia"=>"Antropologia", "Aquacultura"=>"Aquacultura", "Arquitetura e Urbanismo"=>"Arquitetura e Urbanismo", "Arquivologia"=>"Arquivologia", "Artes Visuais"=>"Artes Visuais", "Biblioteconomia"=>"Biblioteconomia", "Biomedicina"=>"Biomedicina", "Ciência da Computação"=>"Ciência da Computação", "Ciências Atuariais"=>"Ciências Atuariais", "Ciências Biológicas"=>"Ciências Biológicas", "Ciências Contábeis"=>"Ciências Contábeis", "Ciências do Estado"=>"Ciências do Estado", "Ciências Econômicas"=>"Ciências Econômicas", "Ciências Sociais"=>"Ciências Sociais", "Ciências Socioambientais"=>"Ciências Socioambientais", "Cinema de Animação e Artes Digitais"=>"Cinema de Animação e Artes Digitais", "Comunicação Social"=>"Comunicação Social", "Conservação e Restauração de Bens Culturais Móveis"=>"Conservação e Restauração de Bens Culturais Móveis", "Controladoria e Finanças"=>"Controladoria e Finanças", "Curso Superior de Tecnologia em Radiologia"=>"Curso Superior de Tecnologia em Radiologia", "Dança"=>"Dança", "Design"=>"Design", "Design de Moda"=>"Design de Moda", "Direito"=>"Direito", "Educação Básica Indígena: Formação Intercultural de Professor - FIEI"=>"Educação Básica Indígena: Formação Intercultural de Professor - FIEI", "Educação Física"=>"Educação Física", "Enfermagem"=>"Enfermagem", "Engenharia Aeroespacial"=>"Engenharia Aeroespacial", "Engenharia Agrícola e Ambiental"=>"Engenharia Agrícola e Ambiental", "Engenharia Ambiental"=>"Engenharia Ambiental", "Engenharia Civil"=>"Engenharia Civil", "Engenharia de Alimentos - Montes Claros"=>"Engenharia de Alimentos - Montes Claros", "Engenharia de Controle e Automação"=>"Engenharia de Controle e Automação", "Engenharia de Minas"=>"Engenharia de Minas", "Engenharia de Produção"=>"Engenharia de Produção", "Engenharia de Sistemas"=>"Engenharia de Sistemas", "Engenharia Elétrica"=>"Engenharia Elétrica", "Engenharia Florestal"=>"Engenharia Florestal", "Engenharia Mecânica"=>"Engenharia Mecânica", "Engenharia Metalúrgica"=>"Engenharia Metalúrgica", "Engenharia Química"=>"Engenharia Química", "Estatística"=>"Estatística", "Farmácia"=>"Farmácia", "Filosofia"=>"Filosofia", "Física"=>"Física", "Fisioterapia"=>"Fisioterapia", "Fonoaudiologia"=>"Fonoaudiologia", "Geografia"=>"Geografia", "Geologia"=>"Geologia", "Gestão de Serviços de Saúde"=>"Gestão de Serviços de Saúde", "Gestão Pública"=>"Gestão Pública", "História"=>"História", "Letras"=>"Letras", "Licenciatura em Educação do Campo"=>"Licenciatura em Educação do Campo", "Licenciatura Intercultural Indígena"=>"Licenciatura Intercultural Indígena", "Matemática"=>"Matemática", "Matemática Computacional"=>"Matemática Computacional", "Medicina"=>"Medicina", "Medicina Veterinária"=>"Medicina Veterinária", "Museologia"=>"Museologia", "Música"=>"Música", "Nutrição"=>"Nutrição", "Odontologia"=>"Odontologia", "Pedagogia"=>"Pedagogia", "Psicologia"=>"Psicologia", "Química"=>"Química", "Química Tecnológica"=>"Química Tecnológica", "Relações Econômicas Internacionais"=>"Relações Econômicas Internacionais", "Sistemas de Informação"=>"Sistemas de Informação", "Teatro (Artes Cênicas)"=>"Teatro (Artes Cênicas)", "Terapia Ocupacional"=>"Terapia Ocupacional", "Turismo"=>"Turismo", "Zootecnia - Montes Claros"=>"Zootecnia - Montes Claros"], null, ['class'=>'ui dropdown']) !!}
				</div>
			</div>
			<div class="ui buttons fluid">
				<a class="ui button" href="/users">Cancelar</a>
				<div class="or" data-text="ou"></div>
				{!! Form::submit('Cadastrar', ['class'=>'ui positive button']) !!}
			</div>
		{!! Form::close() !!}
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});

		$(document).ready(function (){
			$('.ui.dropdown').dropdown();
			$('.ui.checkbox').checkbox();

			var maskBehavior = function (val) {
				return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
			},
			options = {onKeyPress: function(val, e, field, options) {
				field.mask(maskBehavior.apply({}, arguments), options);
			}};

			$('#phone').mask(maskBehavior, options);

			$('input[type=radio][name=type]').change(function() {
				if (this.value == 'Aluno') {
					$('#enrollment').val("");
					$('#enrollment').attr("placeholder", "Matrícula do Aluno");
					$('#enrollment').mask("0000000000");
					$('#department').parent().hide();
					$('#course').parent().parent().show();
				}
				else {
					$('#enrollment').val("");
					$('#enrollment').attr("placeholder", "Matrícula do Servidor");
					$('#enrollment').mask("000000-0");
					$('#department').parent().show();
					$('#course').parent().parent().hide();
				}
			});
		});
	</script>
@stop
