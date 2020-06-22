<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines contain the default error messages used by
      | the validator class. Some of these rules have multiple versions such
      | as the size rules. Feel free to tweak each of these messages here.
      |
     */

    'accepted' => ':attribute deve ser aceito.',
    'active_url' => ':attribute não é uma URL válida.',
    'after' => ':attribute deve ser uma data depois de :date.',
    'alpha' => ':attribute deve conter somente letras.',
    'alpha_dash' => ':attribute deve conter letras, números e traços.',
    'alpha_num' => ':attribute deve conter somente letras e números.',
    'array' => ':attribute deve ser um array.',
    'before' => ':attribute deve ser uma data antes de :date.',
    'between' => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file' => ':attribute deve estar entre :min e :max kilobytes.',
        'string' => ':attribute deve estar entre :min e :max caracteres.',
        'array' => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => ':attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação de :attribute não confere.',
    'date' => ':attribute não é uma data válida.',
    'date_format' => ':attribute não confere com o formato :format.',
    'different' => ':attribute e :other devem ser diferentes.',
    'digits' => ':attribute deve ter :digits dígitos.',
    'digits_between' => ':attribute deve ter entre :min e :max dígitos.',
    'email' => ':attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'filled' => ':attribute é um campo obrigatório.',
    'image' => ':attribute deve ser uma imagem.',
    'in' => ':attribute é inválido.',
    'integer' => ':attribute deve ser um inteiro.',
    'ip' => ':attribute deve ser um endereço IP válido.',
    'json' => ':attribute deve ser um JSON válido.',
    'max' => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file' => ':attribute não deve ter mais que :max kilobytes.',
        'string' => ':attribute não deve ter mais que :max caracteres.',
        'array' => ':attribute não pode ter mais que :max itens.',
    ],
    'mimes' => ':attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve ser no mínimo :min.',
        'file' => ':attribute deve ter no mínimo :min kilobytes.',
        'string' => ':attribute deve ter no mínimo :min caracteres.',
        'array' => ':attribute deve ter no mínimo :min itens.',
    ],
    'not_in' => 'O :attribute selecionado é inválido.',
    'numeric' => ':attribute deve ser um número.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same' => ':attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => ':attribute deve ser :size.',
        'file' => ':attribute deve ter :size kilobytes.',
        'string' => ':attribute deve ter :size caracteres.',
        'array' => ':attribute deve conter :size itens.',
    ],
    'string' => ':attribute deve ser uma string',
    'timezone' => ':attribute deve ser uma timezone válida.',
    'unique' => ':attribute já está em uso.',
    'url' => 'O formato de :attribute é inválido.',
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | Here you may specify custom validation messages for attributes using the
      | convention "attribute.rule" to name the lines. This makes it quick to
      | specify a specific custom language line for a given attribute rule.
      |
     */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => [
        'CAT_CODIGO' => 'CATEGORIA',
        'CAT_NOME' => 'NOME DA CATEGORIA',
        'CAT_ORDEM' => 'ORDEM DA CATEGORIA',
        
        'COLA_CODIGO' => 'COLABORADOR',
        'COLA_MATRICULA' => 'MATRÍCULA',
        'COLA_FUNCAO' => 'FUNÇÃO',
        
        'DI_CODIGO' => 'IMPRENSA',
        'DI_NOME' => 'NOME DA IMPRENSA',
        'DI_FONE1' => 'FONE 1',
        'DI_FONE2' => 'FONE 2',
        'DI_FONE3' => 'FONE 3',
        'DI_ENDERECO' => 'ENDERECO DA IMPRENSA',
        'DI_LOGO' => 'LOGO DA IMPRENSA',
        'DI_SITE' => 'SITE DA IMPRENSA',
        'DI_EMAIL' => 'EMAIL DA IMPRENSA',
        'DI_HORALIMITE' => 'HORÁRIO LIMITE',
        
        'DEP_CODIGO' => 'DEPARTAMENTO',
        'DEP_NOME' => 'NOME DO DEPARTAMENTO',
        'DEP_CIDADE' => 'CIDADE SEDE DO DEPARTAMENTO',
        'DEP_ORDEM' => 'ORDEM DO DEPARTAMENTO',
        
        'DOC_CODIGO' => 'DOCUMENTO',
        'DOC_NUMERO' => 'NÚMERO DO DOCUMENTO',
        'DOC_DATA' => 'DATA DO DOCUMENTO',
        'DOC_TEXTO' => 'TEXTO DO DOCUMENTO',
        'DOC_STATUS' => 'STATUS DO DOCUMENTO',
        'DOC_STATUSDIARIO' => 'STATUS DO DIÁRIO EM RELAÇÃO AO DOCUMENTO',
        'DOC_VERSAO' => 'VERSÃO DO DOCUMENTO',
        'DOC_TAGS' => 'TAGS DO DOCUMENTO',
        'DOC_REPETIR' => 'NÚMERO DE PUBLICAÇÕES DO DOCUMENTO',
        
        'EDI_CODIGO' => 'EDIÇÃO',
        'EDI_NUMERO' => 'NÚMERO DA EDIÇÃO',
        'EDI_DATA' => 'DATA DA EDIÇÃO',
        'EDI_SUPLEMENTO' => 'SUPLEMENTO DA EDIÇÃO',
        'EDI_NUMPG' => 'NÚMERO DE PÁGINAS',
        'EDI_STATUS' => 'STATUS DA EDIÇÃO',
        'EDI_PDF' => 'PDF DA EDIÇÃO',
        
        
        'END_CODIGO' => 'ENDEREÇO',
        'END_CEP' => 'CEP',
        'END_LOGRADOURO' => 'LOGRADOURO',
        'END_TIPOLOGRADOURO' => 'TIPO DE LOGRADOURO',
        'END_BAIRRO' => 'BAIRRO',
        'END_CIDADE' => 'CIDADE',
        'END_UF' => 'UF',
        'END_COMPLEMENTO' => 'COMPLEMENTO',
        'END_NÚMERO' => 'NÚMERO',
        
        'EXP_CODIGO' => 'EXPEDIENTE',
        'EXP_NOME' => 'NOME DO FUNCIONÁRIO',
        'EXP_CARGO' => 'COMPETÊNCIA',
        'EXP_TELEFONE' => 'TELEFONE',
        
        'ORG_CODIGO' => 'ÓRGÃO',
        'ORG_NOME' => 'NOME DO ÓRGÃO',
        'ORG_SIGLA' => 'SIGLA DO ÓRGÃO',
        'ORG_ORDEM' => 'ORDEM DO ÓRGÃO',
        'ORG_TAXADO' => 'TAXADO?',
        'ORG_PODER' => 'TIPO DE PODER',
        
        'PES_CODIGO' => 'PESSOA',
        'PF_NOME' => 'NOME COMPLETO',
        'PF_GENERO' => 'GÊNERO',
        'PF_DATANASCIMENTO' => 'DATA DE NASCIMENTO',
        'PF_CPF' => 'CPF',
        'PF_RG' => 'RG',
        'PF_ESCOLARIDADE' => 'ESCOLARIDADE',
        'PF_FOTO' => 'FOTO',
        
        'PJ_NOMEFANTASIA' => 'NOME FANTASIA',
        'PJ_RAZAOSOCIAL' => 'RAZÃO SOCIAL',
        'PJ_INSCESTADUAL' => 'INSCRIÇÃO ESTADUAL',
        'PJ_INSCMUNICIPAL' => 'INSCRIÇÃO MUNICIPAL',
        'PJ_CNPJ' => 'CNPJ',
        
        'REV_CODIGO' => 'REVISÃO',
        'REV_TEXTO' => 'TEXTO DA REVISÃO',
        'REV_HORAREVISAO' => 'HORA DA REVISÃO',
        
        'SOL_CODIGO' => 'SOLICITAÇÃO',
        'SOL_PEDIDO' => 'PEDIDO SOLICITAÇÃO',
        'SOL_RESPOSTA' => 'RESPOSTA DA SOLICITAÇÃO',
        'SOL_STATUS' => 'STATUS DA SOLICITAÇÃO',
        'SOL_CHECK' => 'CHECK',
        
        'SUB_CODIGO' => 'SUBCATEGORIA',
        'SUB_NOME' => 'NOME DA SUBCATEGORIA',
        'SUB_DESCRICAO' => 'DESCRIÇÃO',
        'SUB_SIGLADOC' => 'SIGLA SUBCATEGORIA',
        
        'SUBDEP_TEXTO' => 'MINUTA DO DOCUMENTO',
        
        'USU_CODIGO' => 'USUÁRIO',
        'USU_EMAIL' => 'EMAIL',
        'USU_NIVEL' => 'NÍVEL DO USUÁRIO',
        'USU_STATUS' => 'STATUS DO USUÁRIO',
        'USU_SENHA' => 'SENHA',
        'USU_SENHA2' => 'SENHA2',
        'USU_FONE1' => 'FONE1',
        'USU_FONE2' => 'FONE2',
        'USU_FONE3' => 'FONE3',
        
        
        
        
        'password' => 'Senha',
    ],
];
