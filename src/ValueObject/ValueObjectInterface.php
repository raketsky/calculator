<?php
declare(strict_types=1);

namespace App\ValueObject;

interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param string $value
     * @return static
     */
    public static function instance(string $value): self;


    /**
     * @param ValueObjectInterface $object
     * @return bool
     */
    public function equals(ValueObjectInterface $object): bool;

    /**
     * @return string
     */
    public function __toString(): string;
}
