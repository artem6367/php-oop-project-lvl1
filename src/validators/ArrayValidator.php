<?php

namespace Hexlet\Validator\validators;

class ArrayValidator extends AbstractValidator
{
    private $validators = [
        'required' => false,
        'sizeof' => false,
        'shape' => false,
    ];

    public function isValid($val): bool
    {
        if (!parent::isValid($val)) {
            return false;
        }

        if ($this->validators['required'] && !isset($val)) {
            return false;
        }

        if ($this->validators['sizeof'] && count($val) != $this->validators['sizeof']) {
            return false;
        }

        if ($this->validators['shape']) {
            foreach ($this->validators['shape'] as $key => $v) {
                if (!$v->isValid($val[$key])) {
                    return false;
                }
            }
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

    public function shape(array $validators): self
    {
        $this->validators['shape'] = $validators;
        return $this;
    }
}
