<?php

namespace Hexlet\Validator\validators;

abstract class BaseValidator
{
    protected $tests;
    protected $name;
    protected $value;

    public function __construct($tests = [])
    {
        $this->tests = $tests;
    }

    abstract public function isValid($value); 

    public function test($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
        return $this;
    }
}