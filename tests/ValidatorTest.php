<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testString(): void
    {
        $v = new Validator();

        $schema = $v->string();

        $schema2 = $v->string();

        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));

        $schema->required();

        $this->assertTrue($schema2->isValid(''));
        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));
        $this->assertTrue($schema->isValid('hexlet'));

        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($schema->contains('whatthe')->isValid('what does the fox say'));

        $this->assertTrue($v->string()->minLength(10)->minLength(5)->isValid('Hexlet'));
    }

    public function testNumber(): void
    {
        $v = new Validator();

        $schema = $v->number();
        $this->assertTrue($schema->isValid(null));

        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(7));

        $this->assertTrue($schema->positive()->isValid(10));

        $schema->range(-5, 5);
        $this->assertFalse($schema->isValid(-3));
        $this->assertTrue($schema->isValid(5));
    }

    public function testArray(): void
    {
        $v = new Validator();

        $schema = $v->array();

        $this->assertTrue($schema->isValid(null));

        $schema = $schema->required();
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet']));

        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['hexlet']));
        $this->assertTrue($schema->isValid(['hexlet', 'code-basics']));
    }

    public function testShape(): void
    {
        $v = new Validator();

        $schema = $v->array();
        $schema->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);

        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));
    }

    public function testAddValidator(): void
    {
        $v = new Validator();

        $fn = fn ($value, $start) => mb_strpos($value, $start) === 0;

        $v->addValidator('string', 'startWith', $fn);
        $schema = $v->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hexlet'));

        $fn = fn ($value, $min) => $value >= $min;
        $v->addValidator('number', 'min', $fn);

        $schema = $v->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }
}
