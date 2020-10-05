<?php
declare(strict_types=1);

namespace App\Request\v1\ParameterTraits;

use Symfony\Component\Validator\Constraints;

trait ResultPrecision
{
    /**
     * @Constraints\NotBlank()
     * @Constraints\Type("integer")
     */
    protected int $resultPrecision;

    private function setResultPrecision(int $precision): void
    {
        $this->resultPrecision = $precision;
    }

    public function getResultPrecision(): int
    {
        return $this->resultPrecision;
    }
}
