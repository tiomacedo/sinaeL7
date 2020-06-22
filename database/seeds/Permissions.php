<?php

use Illuminate\Database\Seeder;

class Permissions extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('permissions')->get()->count() == 0) {
            DB::table('permissions')->insert([

                /* permissão gral de administrador (ADMIN) */
                [
                    'id' => 1,
                    'name' => 'SUPERADMIN',
                    'label' => 'Perfil implantador BemFuncional',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                /* permissão gral de administrador (ADMIN) */
                [
                    'id' => 2,
                    'name' => 'GERENCIAMENTO FULL-USERS',
                    'label' => 'Gerenciamento geral de usuários e atribuições de perfis, com exceçãos da criaçao de novos tipos de Permissões e Papéis e a exclusão do Implantador do Sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'GERENCIAMENTO USUARIOS',
                    'label' => 'Gerenciamento de usuários e seus dados complementares limitados a não atribuição de perfis.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'GERENCIAMENTO INSTITUCIONAL',
                    'label' => 'Gerencia os dados da CIMADSETA.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'GERENCIAMENTO DE AREAS E IGREJAS',
                    'label' => 'Gerencia os dados das ÁREAS DE SUPERVISÃO E OS DADOS DAS IGREJAS.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'GERENCIAMENTO CONTABIL',
                    'label' => 'Gerencia as contas (receitas e despesas) e patrimônios, gerencia boletos (inclusive baixa manual) e envia boleto de cobrança para o usuário.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'GERENCIAMENTO DE EVENTOS',
                    'label' => 'Gerencia eventos (editais e comunicados) das AGOs e AGEs.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'GERENCIAMENTO DE CREDENCIAIS',
                    'label' => 'Autorização para a impressão e alteração do status de emissão.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                
                /* solicitações usuários (TODOS USUÁRIOS SOLICITAM, exceto os perfis da ImprensaOficial) */
                [
                    'id' => 9,
                    'name' => 'VERIFICAR LOGS',
                    'label' => 'Permite visualizar todos as interações dos usuários com o sistema (login, logout, ação).',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                
                /* gera e visualiza boletos e recibos das contas pagas  */
                [
                    'id' => 10,
                    'name' => 'MINHAS FINANCAS',
                    'label' => 'Gerencia boletos do dízimo dos dízimos e dízimo de obreiros e pode imprimir os recibos.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                /* gera e visualiza boletos e recibos das contas pagas  */
                [
                    'id' => 11,
                    'name' => 'MEU PERFIL',
                    'label' => 'Gerencia boletos do dízimo dos dízimos e dízimo de obreiros e pode imprimir os recibos.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 12,
                    'name' => 'MINHA CREDENCIAL',
                    'label' => 'Visualiza a sua credencial e pode imprimi-lá.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 13,
                    'name' => 'FAZER SOLICITACAO',
                    'label' => 'Efetua solcitações diversars aos administradores do sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 14,
                    'name' => 'RESPONDER SOLICITACAO',
                    'label' => 'Responde os chamados(solicitações) dos usuários',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 15,
                    'name' => 'TRANSPARENCIA',
                    'label' => 'Visualiza as principais informações da contabilidade da instituição.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 16,
                    'name' => 'ITENS EXCLUIDOS',
                    'label' => 'Restaura os dados excluídos ou elimina do Banco de Dados de forma permanente.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 17,
                    'name' => 'MINHA ÁREA',
                    'label' => 'Altera endereço e telefone das Igrejas e Usuários da área da qual é presidente/supervisor.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                
                
                
                
            ]);
        } else {
            echo "\e[31mPermission não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
