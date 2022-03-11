<?php

namespace Hexlet\Validator\validators;

class ArrayValidator
{
    private $required = false;
    private $sizeof;

    public function isValid($data)
    {
        if ($this->required && !is_array($data)) {
            return false;
        }

        if ($this->sizeof && count($data) < $this->sizeof) {
            return false;
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
}