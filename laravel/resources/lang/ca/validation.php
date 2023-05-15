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

    'accepted' => 'El camp :attribute ha de ser acceptat.',
    'accepted_if' => 'El camp :attribute ha de ser acceptat quan :other sigui :value.',
    'active_url' => 'El camp :attribute no és una URL vàlida.',
    'after' => 'El camp :attribute ha de ser una data posterior a :date.',
    'after_or_equal' => 'El camp :attribute ha de ser una data posterior o igual a :date.',
    'alpha' => 'El camp :attribute només pot contenir lletres.',
    'alpha_dash' => 'El camp :attribute només pot contenir lletres, números, guions i guions baixos.',
    'alpha_num' => 'El camp :attribute només pot contenir lletres i números.',
    'array' => 'El camp :attribute ha de ser un array.',
    'before' => 'El camp :attribute ha de ser una data anterior a :date.',
    'before_or_equal' => 'El camp :attribute ha de ser una data anterior o igual a :date.',
    'between' => [
        'numeric' => 'El camp :attribute ha d\'estar entre :min i :max.',
        'file' => 'El camp :attribute ha de tenir entre :min i :max kilobytes.',
        'string' => 'El camp :attribute ha de tenir entre :min i :max caràcters.',
        'array' => 'El camp :attribute ha de tenir entre :min i :max elements.',
    ],
    'boolean' => 'El camp :attribute ha de ser verdader o fals.',
    'confirmed' => 'La confirmació del camp :attribute no coincideix.',
    'current_password' => 'La contrasenya és incorrecta.',
    'date' => 'El camp :attribute no és una data vàlida.',
    'date_equals' => 'El camp :attribute ha de ser una data igual a :date.',
    'date_format' => 'El camp :attribute no coincideix amb el format :format.',
    'declined' => 'El camp :attribute ha de ser rebutjat.',
    'declined_if' => 'El camp :attribute ha de ser rebutjat quan :other sigui :value.',
    'different' => 'El camp :attribute i :other han de ser diferents.',
    'digits' => 'El camp :attribute ha de tenir :digits dígits.',
    'digits_between' => 'El camp :attribute ha de tenir entre :min i :max dígits.',
    'dimensions' => 'El camp :attribute té dimensions d\'imatge no vàlides.',
    'distinct' => 'El camp :attribute té un valor duplicat.',
    'email' => 'El camp :attribute ha de ser una adreça de correu electrònic vàlida.',
    'ends_with' => 'El camp :attribute ha de finalitzar amb un dels següents valors: :values.',
    'enum' => 'El :attribute seleccionat no és vàlid.',
    'exists' => 'El :attribute seleccionat no és vàlid.',
    'file' => 'El camp :attribute ha de ser un fitxer.',
    'filled' => 'El camp :attribute ha de tenir un valor.',
    'gt' => [
        'numeric' => 'El camp :attribute ha de ser més gran que :value.',
        'file' => 'El camp :attribute ha de ser més gran que :value kilobytes.',
        'string' => 'El camp :attribute ha de ser més gran que :value caràcters.',
        'array' => 'El camp :attribute ha de tenir més de :value elements.',
    ],
    'gte' => [
        'numeric' => 'El camp :attribute ha de ser més gran o igual que :value.',
        'file' => 'El camp :attribute ha de ser més gran o igual que :value kilobytes.',
        'string' => 'El camp :attribute ha de ser més gran o igual que :value caràcters.',
        'array' => 'El camp :attribute ha de tenir :value elements o més.',
    ],
    'image' => 'El camp :attribute ha de ser una imatge.',
    'in' => 'El camp :attribute seleccionat no és vàlid.',
    'in_array' => 'El camp :attribute no existeix a :other.',
    'integer' => 'El camp :attribute ha de ser un nombre enter.',
    'ip' => 'El camp :attribute ha de ser una adreça IP vàlida.',
    'ipv4' => 'El camp :attribute ha de ser una adreça IPv4 vàlida.',
    'ipv6' => 'El camp :attribute ha de ser una adreça IPv6 vàlida.',
    'json' => 'El camp :attribute ha de ser una cadena JSON vàlida.',
    'lt' => [
        'numeric' => 'El camp :attribute ha de ser inferior a :value.',
        'file' => 'El camp :attribute ha de ser inferior a :value kilobytes.',
        'string' => 'El camp :attribute ha de ser inferior a :value caràcters.',
        'array' => 'El camp :attribute ha de tenir menys de :value elements.',
    ],
    'lte' => [
        'numeric' => 'El camp :attribute ha de ser inferior o igual a :value.',
        'file' => 'El camp :attribute ha de ser inferior o igual a :value kilobytes.',
        'string' => 'El camp :attribute ha de ser inferior o igual a :value caràcters.',
        'array' => 'El camp :attribute no ha de tenir més de :value elements.',
    ],
    'mac_address' => 'El camp :attribute ha de ser una adreça MAC vàlida.',
    'max' => [
        'numeric' => 'El camp :attribute no pot ser més gran que :max.',
        'file' => 'El camp :attribute no pot ser més gran que :max kilobytes.',
        'string' => 'El camp :attribute no pot ser més gran que :max caràcters.',
        'array' => 'El camp :attribute no pot tenir més de :max elements.',
    ],
    'mimes' => 'El camp :attribute ha de ser un fitxer del tipus: :values.',
    'mimetypes' => 'El camp :attribute ha de ser un fitxer del tipus: :values.',
    'min' => [
        'numeric' => 'El camp :attribute ha de ser com a mínim :min.',
        'file' => 'El camp :attribute ha de ser com a mínim :min kilobytes.',
        'string' => 'El camp :attribute ha de ser com a mínim :min caràcters.',
        'array' => 'El camp :attribute ha de tenir com a mínim :min elements.',
    ],
    'multiple_of' => 'El :attribute ha de ser múltiple de :value.',
    'not_in' => 'La opció seleccionada :attribute no és vàlida.',
    'not_regex' => 'El format de :attribute no és vàlid.',
    'numeric' => 'El :attribute ha de ser un número.',
    'password' => 'La contrasenya és incorrecta.',
    'present' => 'El camp :attribute ha d\'estar present.',
    'prohibited' => 'El camp :attribute està prohibit.',
    'prohibited_if' => 'El camp :attribute està prohibit quan :other és :value.',
    'prohibited_unless' => 'El camp :attribute està prohibit a menys que :other estigui en :values.',
    'prohibits' => 'El camp :attribute prohibeix que :other estigui present.',
    'regex' => 'El format de :attribute no és vàlid.',
    'required' => 'El camp :attribute és obligatori.',
    'required_array_keys' => 'El camp :attribute ha de contenir entrades per a: :values.',
    'required_if' => 'El camp :attribute és obligatori quan :other és :value.',
    'required_unless' => 'El camp :attribute és obligatori a menys que :other estigui en :values.',
    'required_with' => 'El camp :attribute és obligatori quan :values està present.',
    'required_with_all' => 'El camp :attribute és obligatori quan :values estan presents.',
    'required_without' => 'El camp :attribute és obligatori quan :values no està present.',
    'required_without_all' => 'El camp :attribute és obligatori quan cap de :values està present.',
    'same' => 'El :attribute i :other han de coincidir.',
    'size' => [
        'numeric' => 'El :attribute ha de ser :size.',
        'file' => 'El :attribute ha de ser de :size kilobytes.',
        'string' => 'El :attribute ha de tenir :size caràcters.',
        'array' => 'El :attribute ha de contenir :size elements.',
    ],
    'starts_with' => 'El :attribute ha de començar amb un dels següents valors: :values.',
    'string' => 'El :attribute ha de ser una cadena de text.',
    'timezone' => 'El :attribute ha de ser una zona horària vàlida.',
    'unique' => 'El :attribute ja ha estat pres.',
    'uploaded' => 'Error en carregar el :attribute.',
    'url' => 'El :attribute ha de ser una URL vàlida.',
    'uuid' => 'El :attribute ha de ser un UUID vàlid.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
