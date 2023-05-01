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

    'accepted' => 'مقدار :attribute باید پذیرفته شود.',
    // 'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'مقدار :attribute باید url باشد.',
    'after' => 'مقدار :attribute باید زمایی بعد از :date باشد.',
    'after_or_equal' => 'مقدار :attribute باید زمانی مثل :date یا بعد از آن باشد.',
    'alpha' => 'مقدار :attribute باید فقط حروف باشد.',
    'alpha_dash' => 'مقدار :attribute میتواند شامل: حروف، اعداد، - و _ باشد.',
    'alpha_num' => 'مقدار :attribute باید فقط شامل حروف و اعداد باشد.',
    'array' => 'مقدار :attribute باید آرایه باشد.',
    'ascii' => 'مقدار :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'مقدار :attribute باید زمانی قبل از :date باشد.',
    'before_or_equal' => 'مقدار :attribute باید زمانی مثل :date یا قبلتر باشد.',
    'between' => [
        'array' => 'مقدار :attribute باید بین :min و :max ایتم باشد.',
        'file' => 'مقدار :attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => 'مقدار :attribute باید بین :min و :max باشد.',
        'string' => 'مقدار :attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'مقدار :attribute باید true یا false باشد.',
    'confirmed' => 'مقدار :attribute field confirmation does not match.',
    'current_password' => 'مقدار پسورد اشتباه است.',
    'date' => 'مقدار :attribute باید ناریخ باشد.',
    'date_equals' => 'مقدار :attribute باید با تاریخ :date برابر باشد.',
    'date_format' => 'مقدار :attribute باید با فرمت :format برابر باشد.',
    'decimal' => 'مقدار :attribute field must have :decimal decimal places.',
    'declined' => 'مقدار :attribute field must be declined.',
    'declined_if' => 'مقدار :attribute field must be declined when :other is :value.',
    'different' => 'مقدار :attribute field and :other must be different.',
    'digits' => 'مقدار :attribute field must be :digits digits.',
    'digits_between' => 'مقدار :attribute field must be between :min and :max digits.',
    'dimensions' => 'مقدار :attribute field has invalid image dimensions.',
    'distinct' => 'مقدار :attribute field has a duplicate value.',
    'doesnt_end_with' => 'مقدار :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'مقدار :attribute field must not start with one of the following: :values.',
    'email' => 'مقدار :attribute باید ایمیل معبتر باشد.',
    'ends_with' => 'مقدار :attribute field must end with one of the following: :values.',
    'enum' => 'the selected :attribute is invalid.',
    'exists' => 'the selected :attribute is invalid.',
    'file' => 'مقدار :attribute باید فایل باشد.',
    'filled' => 'مقدار :attribute باید مقداری داشته باشد.',
    'gt' => [
        'array' => 'مقدار :attribute باید بیشتر از :value ایتم باشد.',
        'file' => 'مقدار :attribute باید بزرگتر از :value کلیوبایت باشد.',
        'numeric' => 'مقدار :attribute باید بزرگتر از :value باشد.',
        'string' => 'مقدار :attribute باید بزرگتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => 'مقدار :attribute field must have :value items or more.',
        'file' => 'مقدار :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'مقدار :attribute field must be greater than or equal to :value.',
        'string' => 'مقدار :attribute field must be greater than or equal to :value characters.',
    ],
    'image' => 'مقدار :attribute باید تصویر باشد.',
    'in' => 'the selected :attribute is invalid.',
    'in_array' => 'مقدار :attribute field must exist in :other.',
    'integer' => 'مقدار :attribute field must be an integer.',
    'ip' => 'مقدار :attribute field must be a valid IP address.',
    'ipv4' => 'مقدار :attribute field must be a valid IPv4 address.',
    'ipv6' => 'مقدار :attribute field must be a valid IPv6 address.',
    'json' => 'مقدار :attribute field must be a valid JSON string.',
    'lowercase' => 'مقدار :attribute field must be lowercase.',
    'lt' => [
        'array' => 'مقدار :attribute field must have less than :value items.',
        'file' => 'مقدار :attribute field must be less than :value kilobytes.',
        'numeric' => 'مقدار :attribute field must be less than :value.',
        'string' => 'مقدار :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'مقدار :attribute field must not have more than :value items.',
        'file' => 'مقدار :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'مقدار :attribute field must be less than or equal to :value.',
        'string' => 'مقدار :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'مقدار :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'مقدار :attribute field must not have more than :max items.',
        'file' => 'مقدار :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'مقدار :attribute field must not be greater than :max.',
        'string' => 'مقدار :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'مقدار :attribute field must not have more than :max digits.',
    'mimes' => 'مقدار :attribute field must be a file of type: :values.',
    'mimetypes' => 'مقدار :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'مقدار :attribute field must have at least :min items.',
        'file' => 'مقدار :attribute field must be at least :min kilobytes.',
        'numeric' => 'مقدار :attribute field must be at least :min.',
        'string' => 'مقدار :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'مقدار :attribute field must have at least :min digits.',
    'missing' => 'مقدار :attribute field must be missing.',
    'missing_if' => 'مقدار :attribute field must be missing when :other is :value.',
    'missing_unless' => 'مقدار :attribute field must be missing unless :other is :value.',
    'missing_with' => 'مقدار :attribute field must be missing when :values is present.',
    'missing_with_all' => 'مقدار :attribute field must be missing when :values are present.',
    'multiple_of' => 'مقدار :attribute field must be a multiple of :value.',
    'not_in' => 'the selected :attribute is invalid.',
    'not_regex' => 'مقدار :attribute field format is invalid.',
    'numeric' => 'مقدار :attribute field must be a number.',
    'password' => [
        'letters' => 'مقدار :attribute field must contain at least one letter.',
        'mixed' => 'مقدار :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'مقدار :attribute field must contain at least one number.',
        'symbols' => 'مقدار :attribute field must contain at least one symbol.',
        'uncompromised' => 'مقدار given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'مقدار :attribute field must be present.',
    'prohibited' => 'مقدار :attribute field is prohibited.',
    'prohibited_if' => 'مقدار :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'مقدار :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'مقدار :attribute field prohibits :other from being present.',
    'regex' => 'مقدار :attribute field format is invalid.',
    'required' => 'مقدار :attribute field is required.',
    'required_array_keys' => 'مقدار :attribute field must contain entries for: :values.',
    'required_if' => 'مقدار :attribute field is required when :other is :value.',
    'required_if_accepted' => 'مقدار :attribute field is required when :other is accepted.',
    'required_unless' => 'مقدار :attribute field is required unless :other is in :values.',
    'required_with' => 'مقدار :attribute field is required when :values is present.',
    'required_with_all' => 'مقدار :attribute field is required when :values are present.',
    'required_without' => 'مقدار :attribute field is required when :values is not present.',
    'required_without_all' => 'مقدار :attribute field is required when none of :values are present.',
    'same' => 'مقدار :attribute field must match :other.',
    'size' => [
        'array' => 'مقدار :attribute field must contain :size items.',
        'file' => 'مقدار :attribute field must be :size kilobytes.',
        'numeric' => 'مقدار :attribute field must be :size.',
        'string' => 'مقدار :attribute field must be :size characters.',
    ],
    'starts_with' => 'مقدار :attribute field must start with one of the following: :values.',
    'string' => 'مقدار :attribute field must be a string.',
    'timezone' => 'مقدار :attribute field must be a valid timezone.',
    'unique' => 'مقدار :attribute has already been taken.',
    'uploaded' => 'مقدار :attribute failed to upload.',
    'uppercase' => 'مقدار :attribute field must be uppercase.',
    'url' => 'مقدار :attribute field must be a valid URL.',
    'ulid' => 'مقدار :attribute field must be a valid ULID.',
    'uuid' => 'مقدار :attribute field must be a valid UUID.',

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
