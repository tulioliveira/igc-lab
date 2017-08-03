<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Equipment::class, function (Faker\Generator $faker) {
    return [
        'code'        => $faker->unique()->isbn10,
        'name'        => $faker->firstName,
        'description' => $faker->paragraph(2)
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'type'       => $faker->randomElement(array('Aluno','Servidor')),
        'enrollment' => $faker->unique()->numerify('##########'),
        'cpf'        => $faker->unique()->numerify('###.###.###-##'),
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email'      => $faker->email,
        'course'     => $faker->randomElement(array("Administração", "Administração - Montes Claros", "Agronomia - Montes Claros", "Antropologia", "Aquacultura", "Arquitetura e Urbanismo", "Arquivologia", "Artes Visuais", "Biblioteconomia", "Biomedicina", "Ciência da Computação", "Ciências Atuariais", "Ciências Biológicas", "Ciências Contábeis", "Ciências do Estado", "Ciências Econômicas", "Ciências Sociais", "Ciências Socioambientais", "Cinema de Animação e Artes Digitais", "Comunicação Social", "Conservação e Restauração de Bens Culturais Móveis", "Controladoria e Finanças", "Curso Superior de Tecnologia em Radiologia", "Dança", "Design", "Design de Moda", "Direito", "Educação Básica Indígena: Formação Intercultural de Professor - FIEI", "Educação Física", "Enfermagem", "Engenharia Aeroespacial", "Engenharia Agrícola e Ambiental", "Engenharia Ambiental", "Engenharia Civil", "Engenharia de Alimentos - Montes Claros", "Engenharia de Controle e Automação", "Engenharia de Minas", "Engenharia de Produção", "Engenharia de Sistemas", "Engenharia Elétrica", "Engenharia Florestal", "Engenharia Mecânica", "Engenharia Metalúrgica", "Engenharia Química", "Estatística", "Farmácia", "Filosofia", "Física", "Fisioterapia", "Fonoaudiologia", "Geografia", "Geologia", "Gestão de Serviços de Saúde", "Gestão Pública", "História", "Letras", "Licenciatura em Educação do Campo", "Licenciatura Intercultural Indígena", "Matemática", "Matemática Computacional", "Medicina", "Medicina Veterinária", "Museologia", "Música", "Nutrição", "Odontologia", "Pedagogia", "Psicologia", "Química", "Química Tecnológica", "Relações Econômicas Internacionais", "Sistemas de Informação", "Teatro (Artes Cênicas)", "Terapia Ocupacional", "Turismo", "Zootecnia - Montes Claros")),
        'department' => null,
    ];
});

