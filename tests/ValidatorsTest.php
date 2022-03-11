<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;

class ValidatorsTest extends TestCase
{
    public function testStringValidator(): void
    {
        $v = new \Hexlet\Validator\Validator();

        $schema = $v->string();
        $schema2 = $v->string();

        $this->assertTrue($schema !== $schema2);

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
}
