<?php

use Illuminate\Database\Seeder;

class Institucional extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('dados_institucionais')->get()->count() == 0) {
            DB::table('dados_institucionais')->insert([
                [
                    'DI_CODIGO' => 1,
                    'DI_NOMEFANTASIA' => 'CIMADSETA',
                    'DI_RAZAOSOCIAL' => "Conv Interest de Min e Igj Assembleia de Deus do SETA",
                    'DI_INSCRICAOMUNICIPAL' => '',
                    'DI_INSCRICAOESTADUAL' => '',
                    'DI_CNPJ' => '17.077.566/0001-14',
                    'DI_ENDERECO' => 'Av. Mangalô, Qd. 07, Lt. 107 – St. Recanto do Bosque',
                    'DI_CIDADE' => 'Goiânia',
                    'DI_UF' => 'GO',
                    'DI_CEP' => '74474-322',
                    'DI_FONE' => '(62)3092-1120',
                    'DI_LOGO' => '',
                    'DI_AGENCIA' => '2981',
                    'DI_AGENCIA_DV' => '',
                    'DI_CONTA' => '2880',
                    'DI_CONTA_DV' => 5,
                    'DI_MENSALIDADE' => 14.00,
                    'DI_MULTA' => 0,
                    'DI_JUROS' => 0,
                    'DI_JUROSAPOS' => 0,
                    'DI_DIASPROTESTO' => 0,
                    'DI_CARTEIRA' => 'RG',
                    'DI_VARIACAOCARTEIRA' => '',
                    'DI_CONVENIO' => 9999999,
                    'DI_RANGE' => '',
                    'DI_CODIGOCLIENTE' => 99999,
                    'DI_MENSAGEM1' => '',
                    'DI_MENSAGEM2' => '',
                    'DI_INSTRUCAO1' => 'SR. CAIXA: LEIA ATENTAMENTE AS INSTRUÇÕES',
                    'DI_INSTRUCAO2' => '- Não receber 20 dias após o vencimento;',
                    'DI_INSTRUCAO3' => '- Pagamento com cheque, quitação somente após a sua liquidação.',
                    'DI_INSTRUCAO4' => '- Após o vencimento com até 10 dias de vencido deverá ser pago exclusivamente nas agências da Caixa Econômica;',
                    'DI_INSTRUCAO5' => '',
                    'DI_ACEITE' => 1,
                    'DI_ESPECIEDOC' => 'DM',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31m Dados Institucionais não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
