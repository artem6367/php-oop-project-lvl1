<?php

namespace Hexlet\Validator\validators;

abstract class AbstractValidator
{
    private $validators = [];

    public function __construct($validators = false)
    {
        $this->validators['custom'] = $validators;
    }

    public function test($name, ...$params)
    {
        $this->validators['custom_params'][$name] = $params;
        return $this;
    }

    public function isValid($val): bool
    {
        if ($this->validators['custom']) {
            foreach ($this->validators['custom'] as $name => $fn) {
                if (!$fn($val, ...$this->validators['custom_params'][$name])) {
                    return false;
                }
            }
        }

        return true;
    }
}