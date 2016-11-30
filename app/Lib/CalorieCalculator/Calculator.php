<?php

namespace App\Lib\CalorieCalculator;

class Calculator
{
    protected $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function calculate(string $type, int $time) : float
    {
        foreach ($this->rules as $rule) {
            if ($rule['type'] == $type) {
                return $time * $rule['calories'];
            }
        }
        return 0;
    }
}