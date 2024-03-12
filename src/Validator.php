<?php

namespace Hexlet\Validator;

class Validator
{
    public $validators = [
        'required' => false,
        'contains' => false,
        'minLength' => false,
    ];

    public function __construct(array $config = [])
    {
        $this->validators['required'] = $config['required'] ?? false;
        $this->validators['contains'] = $config['contains'] ?? false;
        $this->validators['minLength'] = $config['minLength'] ?? false;
    }

    public function isValid($val): bool
    {
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

    public function string(): self
    {
        return new self();
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