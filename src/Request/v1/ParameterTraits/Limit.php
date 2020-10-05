<?php
declare(strict_types=1);

namespace App\Request\v1\ParameterTraits;

use Symfony\Component\Validator\Constraints;

trait Limit
{
    /**
     * @Constraints\Positive
     */
    protected int $limit;

    private function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
