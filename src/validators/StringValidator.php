<?php

namespace Hexlet\Validator\validators;

class StringValidator extends BaseValidator
{
    private $required = false;
    private $substr = '';
    private $minLength;

    public function isValid($text)
    {
        if ($this->name && $this->value) {
            return $this->tests[$this->name]($text, $this->value);
        }

        if ($this->required && empty($text)) {
            return false;
        }

        if ($this->substr && mb_strpos($text, $this->substr) === false) {
            return false;
        }

        if ($this->minLength && mb_strlen($text) < $this->minLength) {
            return false;
        }

        return true;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function contains($substr)
    {
        $this->substr = $substr;
        return $this;
    }

    public function minLength($length)
    {
        $this->minLength = $length;
        return $this;
    }
}