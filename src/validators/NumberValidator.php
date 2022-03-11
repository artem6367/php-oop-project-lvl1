<?php

namespace Hexlet\Validator\validators;

class NumberValidator extends BaseValidator
{
    private $required = false;
    private $positive = false;
    private $min;
    private $max;

    public function isValid($number)
    {
        if ($this->name && $this->value) {
            return $this->tests[$this->name]($number, $this->value);
        }

        if ($this->required && empty($number)) {
            return false;
        }

        if ($this->positive && $number < 0) {
            return false;
        }

        if ($this->min && $this->max && ($number < $this->min || $number > $this->max)) {
            return false;
        }

        return true;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function positive()
    {
        $this->positive = true;
        return $this;
    }

    public function range($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
        return $this;
    }
}