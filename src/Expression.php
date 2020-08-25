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
        return $this->add($this->sanitize($value));
    }

    public function then($value)
    {
        $value = $this->sanitize($value);

        return $this->find($value);
    }

    public function anything()
    {
        $this->add('.*');

        return $this;
    }

    public function maybe($value)
    {
        $value = $this->sanitize($value);

        return $this->add("(?:$value)?");
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

    protected function add($value)
    {
        $this->expression .= $value;

        return $this;
    }

    protected function sanitize($value)
    {
        return preg_quote($value, '/');
    }
}

