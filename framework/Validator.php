<?php

namespace Framework;

class Validator
{
    public static function validate($data, $rules)
    {
        $errors = [];
        $validated = [];

        foreach ($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            $validated[$field] = $data[$field];
            foreach ($rulesArray as $rule) {
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field][] = "$field, The $field field is required.";
                }
                if ($rule === 'string' && !is_string($data[$field])) {
                    $errors[$field][] = "$field, The $field field must be a string.";
                }
                if ($rule === 'email' && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "$field, The $field field must be a valid email address.";
                }
                if ($rule === 'numeric' && !is_numeric($data[$field])) {
                    $errors[$field][] = "$field, The $field field must be a number.";
                }
                if ($rule === 'integer' && filter_var($data[$field], FILTER_VALIDATE_INT) === false) {
                    $errors[$field][] = "$field, The $field field must be an integer.";
                }
                if (strpos($rule, 'min:') === 0) {
                    $minValue = (int)str_replace('min:', '', $rule);
                    if ($data[$field] < $minValue) {
                        $errors[$field][] = "$field, The $field field must be at least $minValue.";
                    }
                }
                if (strpos($rule, 'max:') === 0) {
                    $maxValue = (int)str_replace('max:', '', $rule);
                    if ($data[$field] > $maxValue) {
                        $errors[$field][] = "$field, The $field field must be no more than $maxValue.";
                    }
                }
                if (strpos($rule, 'minlength:') === 0) {
                    $minLength = (int)str_replace('minlength:', '', $rule);
                    if (strlen($data[$field]) < $minLength) {
                        $errors[$field][] = "$field, The $field field must be at least $minLength characters.";
                    }
                }
                if (strpos($rule, 'maxlength:') === 0) {
                    $maxLength = (int)str_replace('maxlength:', '', $rule);
                    if (strlen($data[$field]) > $maxLength) {
                        $errors[$field][] = "$field, The $field field must be no more than $maxLength characters.";
                    }
                }
            }
        }

        if (empty($errors)) return $validated;

        http_response_code(422);
        Response::json(['errors' => $errors]);
        exit();
    }

}
