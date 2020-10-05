<?php
declare(strict_types=1);

namespace App\Request\v1\ParameterTraits;

use Symfony\Component\Validator\Constraints;

trait NumberA
{
    /**
     * @Constraints\Type("numeric")
     * @Constraints\NotBlank()
     */
    private string $numberA;

    private function setNumberA(string $value): void
    {
        $this->numberA = $value;
    }

    public function getNumberA(): string
    {
        return $this->numberA;
    }
}
