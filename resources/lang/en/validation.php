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

    'is_valid_rut'         => 'El rut especificado no es válido',
    'fecha_no_supera_actual' => 'La fecha proporcionada no puede ser superior a la actual',
    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute puede contener sólo letras, números y guiones.',
    'alpha_num'            => 'El campo :attribute sólo puede contener números.',
    'array'                => 'El campo :attribute debe ser un arreglo.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a la actual.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a la actual.',
    'between'              => [
        'numeric' => 'El campo :attribute debe encontrarse entre :min y :max.',
        'file'    => 'El campo :attribute debe encontrarse entre :min y :max kilobytes de tamaño.',
        'string'  => 'El campo :attribute debe ser de entre :min y :max caracteres de largo.',
        'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser true o false..',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    'different'            => 'El campo :attribute y :otherdeben ser diferentes.',
    'digits'               => 'El campo :attribute debe contar con :digits dígitos.',
    'digits_between'       => 'El campo :attribute must be between :min and :max digits.',
    'dimensions'           => 'El campo :attribute has invalid image dimensions.',
    'distinct'             => 'El campo :attribute field has a duplicate value.',
    'email'                => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'exists'               => 'El campo selected :attribute is invalid.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute field must have a value.',
    'image'                => 'El campo :attribute must be an image.',
    'in'                   => 'El valor :attribute seleccionado es inválido.',
    'in_array'             => 'El campo :attribute field does not exist in :other.',
    'integer'              => 'El campo :attribute must be an integer.',
    'ip'                   => 'El campo :attribute must be a valid IP address.',
    'ipv4'                 => 'El campo :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'El campo :attribute must be a valid IPv6 address.',
    'json'                 => 'El campo :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'El campo :attribute may not be greater than :max.',
        'file'    => 'El campo :attribute may not be greater than :max kilobytes.',
        'string'  => 'El campo :attribute may not be greater than :max characters.',
        'array'   => 'El campo :attribute may not have more than :max items.',
    ],
    'mimes'                => 'El campo :attribute must be a file of type: :values.',
    'mimetypes'            => 'El campo :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute ser superior o igual a :min.',
        'file'    => 'El :attribute debe ser al menos de tamaño :min kilobytes.',
        'string'  => 'El campo :attribute debe tener al menos :min caracteres de largo.',
        'array'   => 'El campo :attribute must have at least :min items.',
    ],
    'not_in'               => 'El campo selected :attribute is invalid.',
    'numeric'              => 'El campo :attribute debe ser un número.',
    'present'              => 'El campo :attribute field must be present.',
    'regex'                => 'El campo :attribute format is invalid.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute field is required when :other is :value.',
    'required_unless'      => 'El campo :attribute field is required unless :other is in :values.',
    'required_with'        => 'El campo :attribute field is required when :values is present.',
    'required_with_all'    => 'El campo :attribute field is required when :values is present.',
    'required_without'     => 'El campo :attribute field is required when :values is not present.',
    'required_without_all' => 'El campo :attribute field is required when none of :values are present.',
    'same'                 => 'El campo :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe contener :size dígitos.',
        'file'    => 'El campo :attribute must be :size kilobytes.',
        'string'  => 'El campo :attribute must be :size characters.',
        'array'   => 'El campo :attribute must contain :size items.',
    ],
    'string'               => 'El campo :attribute debe ser un string.',
    'timezone'             => 'El campo :attribute must be a valid zone.',
    'unique'               => 'El campo :attribute has already been taken.',
    'uploaded'             => 'El campo :attribute failed to upload.',
    'url'                  => 'El campo :attribute format is invalid.',

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

    'attributes' => [],

];
