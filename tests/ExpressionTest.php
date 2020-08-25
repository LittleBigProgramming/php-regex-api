<?php 
use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase
{
    function test_it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        $this->assertTrue($regex->test('www'));

        $regex = Expression::make()->then('www');
        $this->assertTrue($regex->test('www'));
    }

    function test_it_checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test('foo'));
    }

    function test_it_maybe_has_a_value()
    {
        $regex = Expression::make()->maybe('https');

    
        $this->assertTrue($regex->test('https'));
        $this->assertTrue($regex->test(''));
    }

    function test_it_can_chain_method_calls()
    {
        $regex = Expression::make()->find('foo')->maybe('bar')->then('baz');
        $this->assertMatchesRegularExpression($regex, 'foobarbaz');
        $this->assertFalse($regex->test('foostringbaz'));
    }

    function test_it_can_exclude_values()
    {
        $regex = Expression::make()
            ->find('foo')
            ->anythingBut('bar')
            ->then('baz');

        $this->assertTrue($regex->test('foobazqux'));
        $this->assertFalse($regex->test('foobarbaz'));
    }
}

