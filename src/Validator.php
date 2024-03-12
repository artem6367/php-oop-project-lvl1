<?php

namespace Hexlet\Validator;

use Hexlet\Validator\validators\ArrayValidator;
use Hexlet\Validator\validators\NumberValidator;
use Hexlet\Validator\validators\StringValidator;

class Validator
{
    public function string(): StringValidator
    {
        return new StringValidator();
    }

    public function number(): NumberValidator
    {
        return new NumberValidator();
    }

    public function array(): ArrayValidator
    {
        return new ArrayValidator();
    }
}