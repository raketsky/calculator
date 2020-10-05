<?php
declare(strict_types=1);

namespace App\Request\v1\ParameterTraits;

use Symfony\Component\Validator\Constraints;

trait NumberB
{
    /**
     * @Constraints\Type("numeric")
     * @Constraints\NotBlank()
     */
    private string $numberB;

    private function setNumberB(string $value): void
    {
        $this->numberB = $value;
    }

    public function getNumberB(): string
    {
        return $this->numberB;
    }
}
