<?php

return [
    // attribute names
    'attributes' => [
        'name' => 'nome',
        'email' => 'e-mail',
        'phone' => 'telefone',
        'document_number' => 'cpf',
    ],
    // error messages
    'messages' => [
        // content not found
        'not_found_content' => 'O conteúdo não foi encontrado.',
        // name
        'name.required' => 'O nome é obrigatório.',
        'name.max' => 'O nome deve ter no máximo :max caracteres.',
        'name.min' => 'O nome deve ter no mínimo :min caracteres.',
        // email
        'email.required' => 'O e-mail é obrigatório.',
        'email.invalid' => 'O e-mail é inválido.',
        'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
        'email.min' => 'O e-mail deve ter no mínimo :min caracteres.',
        'email.unique' => 'O e-mail já está em uso.',
        // phone
        'phone.required' => 'O telefone é obrigatório.',
        'phone.invalid' => 'O telefone é inválido.',
        // document number
        'document_number.required' => 'O CPF é obrigatório.',
        'document_number.invalid' => 'O CPF é inválido.',
    ]
];