<?php

namespace Core;

use Valitron\Validator;

class Model
{

    protected array $fillable = [];
    public array $attributes = [];
    protected array $errors = [];

    public function loadData(): void
    {
        $data = request()->getData();
        foreach ($this->fillable as $field) {
            if (isset($data[$field])) {
                $this->attributes[$field] = $data[$field];
            } else {
                $this->attributes[$field] = '';
            }
        }
    }


    public function getErrors(): array
    {
        return $this->errors;
    }
}
