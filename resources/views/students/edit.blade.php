@extends('layouts.app')

@section('content')
	@if (isset($student))
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
			{!! Form::model($student, ['method'=>'PATCH', 'action'=>['StudentsController@update', $student->id], 'class'=>'ui form']) !!}
				{{csrf_field()}}
				<h2 class="ui dividing header">Cadastrar Aluno</h2>
				<div class="fields">
					<div class="four wide required field {{ $errors->has('enrollment') ? 'error' : '' }}">
						{!! Form::label('enrollment', 'Matrícula') !!}
						{!! Form::text('enrollment', null, ['placeholder'=>'Matrícula do Aluno','data-mask'=>'0000000000']) !!}
					</div>
					<div class="four wide required field {{ $errors->has('cpf') ? 'error' : '' }}">
						{!! Form::label('cpf', 'CPF') !!}
						{!! Form::text('cpf', null, ['placeholder'=>'CPF do Aluno','data-mask'=>'000.000.000-00']) !!}
					</div>
					<div class="eight wide required field {{ $errors->has('name') ? 'error' : '' }}">
						{!! Form::label('name', 'Nome Completo') !!}
						{!! Form::text('name', null, ['placeholder'=>'Nome Completo do Aluno']) !!}
					</div>
				</div>
				<div class="fields">
					<div class="six wide required field {{ $errors->has('email') ? 'error' : '' }}">
						{!! Form::label('email', 'E-mail') !!}
						{!! Form::email('email', null, ['placeholder'=>'E-mail do Aluno']) !!}
					</div>
					<div class="four wide required field {{ $errors->has('course') ? 'error' : '' }}">
						{!! Form::label('course', 'Curso') !!}
						{!! Form::select('course', ["Administração"=>"Administração", "Administração - Montes Claros"=>"Administração - Montes Claros", "Agronomia - Montes Claros"=>"Agronomia - Montes Claros", "Antropologia"=>"Antropologia", "Aquacultura"=>"Aquacultura", "Arquitetura e Urbanismo"=>"Arquitetura e Urbanismo", "Arquivologia"=>"Arquivologia", "Artes Visuais"=>"Artes Visuais", "Biblioteconomia"=>"Biblioteconomia", "Biomedicina"=>"Biomedicina", "Ciência da Computação"=>"Ciência da Computação", "Ciências Atuariais"=>"Ciências Atuariais", "Ciências Biológicas"=>"Ciências Biológicas", "Ciências Contábeis"=>"Ciências Contábeis", "Ciências do Estado"=>"Ciências do Estado", "Ciências Econômicas"=>"Ciências Econômicas", "Ciências Sociais"=>"Ciências Sociais", "Ciências Socioambientais"=>"Ciências Socioambientais", "Cinema de Animação e Artes Digitais"=>"Cinema de Animação e Artes Digitais", "Comunicação Social"=>"Comunicação Social", "Conservação e Restauração de Bens Culturais Móveis"=>"Conservação e Restauração de Bens Culturais Móveis", "Controladoria e Finanças"=>"Controladoria e Finanças", "Curso Superior de Tecnologia em Radiologia"=>"Curso Superior de Tecnologia em Radiologia", "Dança"=>"Dança", "Design"=>"Design", "Design de Moda"=>"Design de Moda", "Direito"=>"Direito", "Educação Básica Indígena: Formação Intercultural de Professor - FIEI"=>"Educação Básica Indígena: Formação Intercultural de Professor - FIEI", "Educação Física"=>"Educação Física", "Enfermagem"=>"Enfermagem", "Engenharia Aeroespacial"=>"Engenharia Aeroespacial", "Engenharia Agrícola e Ambiental"=>"Engenharia Agrícola e Ambiental", "Engenharia Ambiental"=>"Engenharia Ambiental", "Engenharia Civil"=>"Engenharia Civil", "Engenharia de Alimentos - Montes Claros"=>"Engenharia de Alimentos - Montes Claros", "Engenharia de Controle e Automação"=>"Engenharia de Controle e Automação", "Engenharia de Minas"=>"Engenharia de Minas", "Engenharia de Produção"=>"Engenharia de Produção", "Engenharia de Sistemas"=>"Engenharia de Sistemas", "Engenharia Elétrica"=>"Engenharia Elétrica", "Engenharia Florestal"=>"Engenharia Florestal", "Engenharia Mecânica"=>"Engenharia Mecânica", "Engenharia Metalúrgica"=>"Engenharia Metalúrgica", "Engenharia Química"=>"Engenharia Química", "Estatística"=>"Estatística", "Farmácia"=>"Farmácia", "Filosofia"=>"Filosofia", "Física"=>"Física", "Fisioterapia"=>"Fisioterapia", "Fonoaudiologia"=>"Fonoaudiologia", "Geografia"=>"Geografia", "Geologia"=>"Geologia", "Gestão de Serviços de Saúde"=>"Gestão de Serviços de Saúde", "Gestão Pública"=>"Gestão Pública", "História"=>"História", "Letras"=>"Letras", "Licenciatura em Educação do Campo"=>"Licenciatura em Educação do Campo", "Licenciatura Intercultural Indígena"=>"Licenciatura Intercultural Indígena", "Matemática"=>"Matemática", "Matemática Computacional"=>"Matemática Computacional", "Medicina"=>"Medicina", "Medicina Veterinária"=>"Medicina Veterinária", "Museologia"=>"Museologia", "Música"=>"Música", "Nutrição"=>"Nutrição", "Odontologia"=>"Odontologia", "Pedagogia"=>"Pedagogia", "Psicologia"=>"Psicologia", "Química"=>"Química", "Química Tecnológica"=>"Química Tecnológica", "Relações Econômicas Internacionais"=>"Relações Econômicas Internacionais", "Sistemas de Informação"=>"Sistemas de Informação", "Teatro (Artes Cênicas)"=>"Teatro (Artes Cênicas)", "Terapia Ocupacional"=>"Terapia Ocupacional", "Turismo"=>"Turismo", "Zootecnia - Montes Claros"=>"Zootecnia - Montes Claros"], null, ['class'=>'ui dropdown']) !!}
					</div>
				</div>
				<div class="ui segment">
					<h4 class="ui dividing header">Endereço & Contato</h4>
					<div class="fields">
						<div class="eight wide required field {{ $errors->has('street') ? 'error' : '' }}">
							{!! Form::label('street', 'Rua') !!}
							{!! Form::text('street', null, ['placeholder'=>'Rua']) !!}
						</div>
						<div class="four wide required field {{ $errors->has('number') ? 'error' : '' }}">
							{!! Form::label('number', 'Número') !!}
							{!! Form::text('number', null, ['placeholder'=>'Número', 'data-mask'=>"00000"]) !!}
						</div>
						<div class="four wide required field {{ $errors->has('zipcode') ? 'error' : '' }}">
							{!! Form::label('zipcode', 'CEP') !!}
							{!! Form::text('zipcode', null, ['placeholder'=>'XXXXX-XXX', 'data-mask'=>"00000-000"]) !!}
						</div>
					</div>
					<div class="fields">
						<div class="five wide required field {{ $errors->has('city') ? 'error' : '' }}">
							{!! Form::label('city', 'Cidade') !!}
							{!! Form::text('city', null, ['placeholder'=>'Cidade']) !!}
						</div>
						<div class="four wide required field {{ $errors->has('state') ? 'error' : '' }}">
							{!! Form::label('state', 'Estado') !!}
							{!! Form::select('state', ["AC"=>"Acre","AL"=>"Alagoas","AP"=>"Amapá","AM"=>"Amazonas","BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espírito Santo","GO"=>"Goiás","MA"=>"Maranhão","MT"=>"Mato Grosso","MS"=>"Mato Grosso do Sul","MG"=>"Minas Gerais","PA"=>"Pará","PB"=>"Paraíba","PR"=>"Paraná","PE"=>"Pernambuco","PI"=>"Piauí","RJ"=>"Rio de Janeiro","RN"=>"Rio Grande do Norte","RS"=>"Rio Grande do Sul","RO"=>"Rondônia","RR"=>"Roraima","SC"=>"Santa Catarina","SP"=>"São Paulo","SE"=>"Sergipe","TO"=>"Tocantins"], null, ['class'=>'ui dropdown']) !!}
						</div>
						<div class="seven wide field {{ $errors->has('complement') ? 'error' : '' }}">
							{!! Form::label('complement', 'Complemento') !!}
							{!! Form::text('complement', null, ['placeholder'=>'Apartamento, bloco, quadra, etc']) !!}
						</div>
					</div>
					<div class="fields">
						<div class="four wide required field {{ $errors->has('phone') ? 'error' : '' }}">
							{!! Form::label('phone', 'Celular') !!}
							{!! Form::text('phone', null, ['placeholder'=>'Celular']) !!}
						</div>
					</div>
				</div>
				<div class="ui buttons fluid">
					<a class="ui button" href="/students">Cancelar</a>
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
			Esse aluno não existe!
		</h2>
		<div class="ui container center aligned">
			<a class="ui primary button" href="/students"><i class="icon left arrow"></i>Voltar</a>
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

			var maskBehavior = function (val) {
				return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
			},
			options = {onKeyPress: function(val, e, field, options) {
				field.mask(maskBehavior.apply({}, arguments), options);
			}};

			$('#phone').mask(maskBehavior, options);
		});
	</script>
@stop