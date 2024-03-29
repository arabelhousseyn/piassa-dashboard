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

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute must have between :min and :max items.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute must be between :min and :max.',
        'string' => 'The :attribute must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute must have more than :value items.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string' => 'The :attribute must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute must have :value items or more.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'array' => 'The :attribute must have less than :value items.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string' => 'The :attribute must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute must not have more than :value items.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute must not have more than :max items.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute must not be greater than :max.',
        'string' => 'The :attribute must not be greater than :max characters.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute must have at least :min items.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'numeric' => ':attribute doit être au moins :min.',
        'string' => ':attribute doit être au moins :min.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute requis.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
        'phone' => [
            'required' => 'Téléphone requis.',
            'digits' => 'Téléphone doit avoir 10 chiffre.',
            'unique' => 'Le téléphone existe déjà.'
        ],
        'password' => [
            'required' => 'Mote de passe requis.',
            'confirmed' => 'Mote de passe ne correspond pas.'
        ],
        'email' => [
            'email' => 'L\'email doit être valide.'
        ],
        'province_id' => [
            'required' => 'Willaya requis.',
            'exists' => 'Willaya n\'existe pas.',
        ],
        'full_name' => [
            'required' => 'Nom complete requis.'
        ],
        'gender' => [
            'required' => 'Sexe requis.'
        ],
        'role' => [
            'required' => 'Role requis.',
            'exists' => 'Role n\'existe pas.'
        ],
        'commercial_registration' => [
            'required' => 'Registre commerce requis.'
        ],
        'nif' => [
            'required' => 'Nif requis.'
        ],
        'num_ar' => [
            'required' => 'Numero ar requis.'
        ],
        'name_company' => [
            'required' => 'Nom entreprise requis.'
        ],
        'contact_name' => [
            'required' => 'Nom contact requis.'
        ],
        'sign_id' => [
            'required' => 'Marque requis.',
            'exists' => 'Marque n\'existe pas.'
        ],
        'year' => [
            'required' => 'Année requis.',
            'date_format' => 'Format invalide.'
        ],
        'user_id' => [
            'required' => 'Utilisateur requis.',
            'exists' => 'Utilisateur n\'existe pas.'
        ],
        'motorisation' => [
            'required' => 'Motorisation requis.'
        ],
        'chassis_number' => [
            'required' => 'N° châssis requis.'
        ],
        'commercial_name' => [
            'required' => 'Nom commercial requis.'
        ],
        'first_name' => [
            'required' => 'Nom requis.'
        ],
        'last_name' => [
            'required' => 'Prénom requis.'
        ],
        'name' => [
            'required' => 'Nom requis.'
        ],
        'type_id' => [
            'required' => 'Type requis.',
            'exists' => 'Type n\'existe pas.'
        ],
        'code' => [
            'required' => 'Code requis.',
            'digits' => 'Code Fromat invalide.',
            'unique' => 'Le code a déjà été pris.'
        ],
        'file' => [
            'required' => 'Fichier excel requis.',
            'mimes' => 'Fichier excel non valide.',
        ],
        'logo' => [
            'required' => 'Logo requis.',
            'url' => 'Logo URL non valide.',
            'mimes' => 'Type logo invalide.',
            'dimensions' => '60 X 70 dimensions logo requis.'
        ],
        'title' => [
            'required' => 'Titre requis.',
            'max' => 'Taille maximum 255.'
        ],

        'body' => [
            'required' => 'Message requis.',
            'max' => 'Taille maximum 255.'
        ],

        'type' => [
            'required' => 'Type requis.'
        ],
        'notification_id' => [
            'required' => 'notification requis.',
            'exists' => 'notification invalide .'
        ],
        'fullName' => [
            'required' => 'Nom complet requis.',
            'max' => 'Taille maximum 255.'
        ],
        'job' => [
            'required' => 'Travaille requis.',
            'max' => 'Taille maximum 255.'
        ],
        'seller_id' => [
            'required' => 'Erreur dans serveur.',
            'exists' => 'Vendeur n\'existe pas.'
        ],
        'old_password' => [
            'required' => 'Ancien mote de passe requis.'
        ],
        'ad' => [
            'required' => 'Ad requis.',
            'mimes' => 'Type non valide.',
            'dimensions' => '1080 X 1920 dimensions logo requis.'
        ],
        'percent' => [
            'required' => 'Pourcentage requis.',
            'numeric' => 'Pourecnetage doit être numeric.'
        ]
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
