<?php

namespace Hexlet\Validator\validators;

class StringValidator extends AbstractValidator
{
    private $validators = [
        'required' => false,
        'contains' => false,
        'minLength' => false,
    ];

    public function isValid($val): bool
    {
        if (!parent::isValid($val)) {
            return false;
        }

        if ($this->validators['required'] && empty($val)) {
            return false;
        }

        if ($this->validators['contains'] && mb_strpos($val, $this->validators['contains']) === false) {
            return false;
        }

        if ($this->validators['minLength'] && mb_strlen($val) < $this->validators['minLength']) {
            return false;
        }

        return true;
    }

    public function required(): self
    {
        $this->validators['required'] = true;
        return $this;
    }

    public function contains(string $str): self
    {
        $this->validators['contains'] = $str;
        return $this;
    }

    public function minLength(int $num): self
    {
        $this->validators['minLength'] = $num;
        return $this;
    }
}
