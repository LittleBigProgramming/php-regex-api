<?php 
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
    function test_it_finds_a_string()
    {
        $regex = Expression::make()->find('www');

        $this-assertRegExp($regex, 'www');
    }
}
