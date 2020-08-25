<?php

class Expression
{
    protected $expression = '';

    public static function make()
    {
        return new static;
    }

    public function find($value)
    {
        $value = $this->sanitize($value);
        $this->expression .= $value;

        return $this;
    }

    public function then($value)
    {
        $value = $this->sanitize($value);

        return $this->find($value);
    }

    public function anything()
    {
        $this->expression .= '.*';

        return $this;
    }

    public function maybe($value)
    {
        $value = $this->sanitize($value);
        $this->expression .= '(' . $value  .  ')?';

        return $this;
    }

    public function test($value)
    {
        return (bool) preg_match($this->getRegex(), $value);
    }

    public function getRegex()
    {
        return '/' . $this->expression . '/';
    }

    public function __toString()
    {
        return $this->getRegex();
    }

    protected function sanitize($value)
    {
        return preg_quote($value, '/');
    }
}

