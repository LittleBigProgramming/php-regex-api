<?php 
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
    function test_it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertMatchesRegularExpression($regex, 'www');

        $regex = Expression::make()->then('www');
        $this->assertMatchesRegularExpression($regex, 'www');
    }

    function test_it_checks_for_anything()
    {
        $regex = Expression::make()->anything();
        $this->assertMatchesRegularExpression($regex, 'foo');
    }

    function test_it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('https');
        $this->assertMatchesRegularExpression($regex, 'https');
        $this->assertMatchesRegularExpression($regex, '');
    }
}

