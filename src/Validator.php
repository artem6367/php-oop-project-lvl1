<?php

namespace Hexlet\Validator;

use Hexlet\Validator\exceptions\NotFoundValidator;

class Validator
{
    private $mapping = [
        'string' => [],
        'number' => [],
        'array' => [],
    ];

    public function __call($name, $arguments)
    {
        $className = 'Hexlet\Validator\validators\\' . ucfirst($name) . 'Validator';

        return new $className($this->mapping[$name]);
    }

    public function addValidator($type, $name, callable $fn)
    {
        if (!isset($this->mapping[$type])) {
            throw new NotFoundValidator();
        }

        $this->mapping[$type][$name] = $fn;
    }
}