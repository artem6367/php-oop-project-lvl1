<?php

namespace Hexlet\Validator;

use Hexlet\Validator\validators\ArrayValidator;
use Hexlet\Validator\validators\NumberValidator;
use Hexlet\Validator\validators\StringValidator;

class Validator
{
    private array $validators = [
        'string' => [],
        'number' => [],
        'array' => [],
    ];

    public function string(): StringValidator
    {
        return new StringValidator($this->validators['string']);
    }

    public function number(): NumberValidator
    {
        return new NumberValidator($this->validators['number']);
    }

    public function array(): ArrayValidator
    {
        return new ArrayValidator($this->validators['array']);
    }

    public function addValidator(string $type, string $name, callable $fn): self
    {
        $this->validators[$type][$name] = $fn;
        return $this;
    }
}
