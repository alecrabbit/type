<?php declare(strict_types=1);
/*
 * This file is part of sebastian/type.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Type;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Type\NullType
 */
final class NullTypeTest extends TestCase
{
    /**
     * @dataProvider assignableTypes
     */
    public function testIsAssignable(Type $assignableType): void
    {
        $type = new NullType();
        $this->assertTrue($type->isAssignable($assignableType));
    }

    public function assignableTypes(): array
    {
        return [
            [new SimpleType('int', false)],
            [new SimpleType('int', true)],
            [new ObjectType(TypeName::fromQualifiedName(self::class), false)],
            [new ObjectType(TypeName::fromQualifiedName(self::class), true)],
            [new UnknownType()],
        ];
    }

    /**
     * @dataProvider notAssignable
     */
    public function testIsNotAssignable(Type $assignedType): void
    {
        $type = new NullType();
        $this->assertFalse($type->isAssignable($assignedType));
    }

    public function notAssignable(): array
    {
        return [
            'void' => [new VoidType()],
        ];
    }

    public function testAllowsNull(): void
    {
        $type = new NullType();
        $this->assertTrue($type->allowsNull());
    }

    public function testReturnTypeDeclaration(): void
    {
        $type = new NullType();
        $this->assertEquals('', $type->getReturnTypeDeclaration());
    }
}