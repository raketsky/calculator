<?php
declare(strict_types=1);

namespace App\ValueObject;

use App\Exception\ValueObjectValidationException;

abstract class AbstractValueObject implements ValueObjectInterface
{
    protected string $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $this->getValidValue($value);
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }

    /**
     * @inheritDoc
     */
    public static function instance(string $value): self
    {
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public function equals(ValueObjectInterface $object): bool
    {
        return $object instanceof static && $object->getValue() === $this->getValue();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }

    protected function getValidationException($value): ValueObjectValidationException
    {
        return new ValueObjectValidationException($this, $value);
    }

    protected function isValidValue($value): bool
    {
        return true; // extend it with logic according VO
    }

    protected function getValidValue($value): string
    {
        if ($this->isValidValue($value)) {
            return $value;
        }

        throw $this->getValidationException($value);
    }
}
