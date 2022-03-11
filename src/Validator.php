<?php

namespace Hexlet\Validator;

use Hexlet\Validator\validators\NumberValidator;
use Hexlet\Validator\validators\StringValidator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }

    public function number()
    {
        return new NumberValidator();
    }
}