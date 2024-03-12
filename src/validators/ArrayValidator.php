<?php

namespace Hexlet\Validator\validators;

class ArrayValidator
{
    private $validators = [
        'required' => false,
        'sizeof' => false,
    ];

    public function isValid(?array $val): bool
    {
        if ($this->validators['required'] && !isset($val)) {
            return false;
        }

        if ($this->validators['sizeof'] && count($val) != $this->validators['sizeof']) {
            return false;
        }

        return true;
    }

    public function required(): self
    {
        $this->validators['required'] = true;
        return $this;
    }

    public function sizeof(int $size): self
    {
        $this->validators['sizeof'] = $size;
        return $this;
    }
}
