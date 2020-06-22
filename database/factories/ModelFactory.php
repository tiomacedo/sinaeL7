<?php

$factory->define('App\Models\Areas', function (Faker\Generator $faker) {
    return [
        'ARE_CODIGOMANUAL' => $faker->randomNumber(2) . "-" . $faker->randomNumber(2),
        'ARE_DESCRICAO' => $faker->text($maxNbChars = 120),
    ];
});

$factory->define('App\Models\Igrejas', function (Faker\Generator $faker) {
    return [
        'IGR_MATRICULA' => $faker->randomNumber(3) . "-" . $faker->randomNumber(2),
        'IGR_RESPONSAVEL' => $faker->firstNameMale . " " . $faker->lastName,
        'IGR_NOMECONGRECACAO' => 'ASSEMBLEIA DE DEUS',
        'IGR_FONE' => "(" . $faker->randomNumber(2) . ")" . $faker->randomNumber(4) . "-" . $faker->randomNumber(4),
        'IGR_CELULAR' => "(" . $faker->randomNumber(2) . ")" . $faker->randomNumber(4) . "-" . $faker->randomNumber(4),
        'IGR_CNPJ' => $faker->randomNumber(2) . "." . $faker->randomNumber(3) . "." . $faker->randomNumber(3) . "/0001-" . $faker->randomNumber(2),
        'IGR_TEMPLO' => $faker->randomElement($array = array('PRÓPRIO', 'ALUGADO', 'COMODATO')),
        'IGR_QTDMISSIONARIOS' => $faker->randomNumber(3),
        'IGR_QTDDIACONOS' => $faker->randomNumber(3),
        'IGR_QTDPRESBITEROS' => $faker->randomNumber(3),
        'IGR_QTDEVANGELISTAS' => $faker->randomNumber(3),
        'IGR_QTDPASTORES' => $faker->randomNumber(3),
        'IGR_QTDMEMBROS' => $faker->randomNumber(3),
        'IGR_QTDELEITORESCIDADE' => $faker->randomNumber(3),
        'IGR_QTDELEITORESIGREJA' => $faker->randomNumber(3),
        'IGR_QTDMEMBROSPOLITICOS' => $faker->randomNumber(3),
        'IGR_QTDFUNCIONARIOSPUBLICOS' => $faker->randomNumber(3),
        'ARE_CODIGO' => $faker->numberBetween(1, 11),
    ];
});

$factory->define('App\Models\User', function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstNameMale . " " . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('vagrant'),
        'remember_token' => str_random(10),
        'IGR_CODIGO' => $faker->numberBetween(1, 10),
        'CID_CODIGO' => 1721000,
        'user_id' => null,
        'matricula' => $faker->year . "-" . $faker->randomDigit,
        'sexo' => 'M',
        'foto' => null,
        'dtnascimento' => $faker->dateTime,
        'cpf' => $faker->cpf,
        'rg' => $faker->rg,
        'pai' => $faker->firstNameMale . " " . $faker->lastName,
        'mae' => $faker->firstNameFemale . " " . $faker->lastName,
        'estadocivil' => 'CASADO',
        'conjuge' => $faker->firstNameFemale . " " . $faker->lastName,
        'dtcasamento' => $faker->dateTime,
        'dtviuvez' => null,
        'nacionalidade' => 'BRASILEIRA',
        'escolaridade' => $faker->randomElement($array = array('SUPERIOR COMPLETO', 'ALFABETIZADO', '2º GRAU COMPLETO')),
        'tp' => 'MIN',
        'phone' => "(" . $faker->randomNumber(2) . ")" . $faker->randomNumber(4) . "-" . $faker->randomNumber(4),
        'cellphone' => "(" . $faker->randomNumber(2) . ")" . $faker->randomNumber(4) . "-" . $faker->randomNumber(4),
        'tx_mensal' => $faker->randomElement($array = array('SIM', 'NÃO')),
        'tx_obreiro' => $faker->randomElement($array = array('SIM', 'NÃO')),
        'tx_dizimo' => $faker->randomElement($array = array('SIM', 'NÃO')),
        'titulo_eleitoral' => $faker->numberBetween(0001, 9999) . "." . $faker->numberBetween(1001, 9999) . "." . $faker->numberBetween(2001, 9999),
        'profissao' => $faker->sentence,
    ];
});
