<?php

namespace Hexlet\Validator\validators;

class NumberValidator extends AbstractValidator
{
    private $validators = [
        'required' => false,
        'positive' => false,
        'range' => false,
    ];

    public function isValid($val): bool
    {
        if (!parent::isValid($val)) {
            return false;
        }

        if ($this->validators['required'] && empty($val)) {
            return false;
        }

        if ($this->validators['positive'] && $val < 0) {
            return false;
        }

        if ($this->validators['range'] && ($val < $this->validators['range'][0] || $val > $this->validators['range'][1])) {
            return false;
        }

        return true;
    }

    public function required()
    {
        $this->validators['required'] = true;
        return $this;
    }

    public function positive()
    {
        $this->validators['positive'] = true;
        return $this;
    }

    public function range(int $start, int $end)
    {
        $this->validators['range'] = [$start, $end];
        return $this;
    }
}