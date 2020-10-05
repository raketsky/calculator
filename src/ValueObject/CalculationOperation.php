<?php
declare(strict_types=1);

namespace App\ValueObject;

final class CalculationOperation extends AbstractValueObject
{
    public const OPERATION_ADD = 'add';
    public const OPERATION_SUB = 'sub';
    public const OPERATION_DIV = 'div';
    public const OPERATION_MUL = 'mul';

    protected function isValidValue($value): bool
    {
        return in_array($value, [
            static::OPERATION_ADD,
            static::OPERATION_SUB,
            static::OPERATION_DIV,
            static::OPERATION_MUL,
        ]);
    }
}
