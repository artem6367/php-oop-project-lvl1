<?php

namespace Hexlet\Validator\validators;

interface ValidatorInterface
{
    public function isValid($val): bool;
}