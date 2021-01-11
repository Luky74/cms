<?php

namespace App\Validation;

class Validator {

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;

    }

    public function validate(array $rules)
    {
        foreach ($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required' :
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min' :
                            $this->min($name, $this->data[$name], $rule);
                        default :
                            break;
                    }
                }
            }
        }
    }

    private function required(string $name, string $value)
    {
        $value = trim($value);
        if (!isset($value) || is_null($value) || empty($value))
            $this->errors[$name][] = "{$name} est requis";
    }

    private function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit) {
                $this->errors[$name][0] = "{$name} doit comprendre un minimum de {$limite} caractères";
            }
    }

    private function getErrors()
    {
        return $this->errors;
    }
}