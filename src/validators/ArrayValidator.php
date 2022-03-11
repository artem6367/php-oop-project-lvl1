<?php

namespace Hexlet\Validator\validators;

class ArrayValidator extends BaseValidator
{
    private $required = false;
    private $sizeof;
    private $shape;

    public function isValid($data)
    {
        if ($this->name && $this->value) {
            return $this->tests[$this->name]($data, $this->value);
        }

        if ($this->required && !is_array($data)) {
            return false;
        }

        if ($this->sizeof && count($data) < $this->sizeof) {
            return false;
        }

        if ($this->shape) {
            foreach ($this->shape as $key => $validator) {
                if (!$validator->isValid($data[$key])) {
                    return false;
                }
            }
        }

        return true;
    }
    
    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function sizeof($size)
    {
        $this->sizeof = $size;
        return $this;
    }

    public function shape($val)
    {
        $this->shape = $val;
        return $this;
    }
}