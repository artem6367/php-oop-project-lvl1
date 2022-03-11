<?php

namespace Hexlet\Validator;

use Hexlet\Validator\validators\StringValidator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }
}