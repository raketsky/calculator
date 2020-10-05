<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\CalculationRecord;
use App\ValueObject\CalculationOperation;
use App\ValueObject\JsonApiType;

class CalculationRecordResource
{
    private ?int $id;
    private CalculationOperation $calculationOperation;
    private string $numberA;
    private string $numberB;
    private ?string $result;

    public function __construct(CalculationRecord $calculationRecord)
    {
        $this->id = $calculationRecord->getId();
        $this->calculationOperation = $calculationRecord->getCalculationOperation();
        $this->numberA = $calculationRecord->getNumberA();
        $this->numberB = $calculationRecord->getNumberB();
        $this->result = $calculationRecord->getResultValue();
    }

    public function getJsonItemResponse(): array
    {
        return [
            'id' => $this->id,
            'type' => JsonApiType::CALCULATION_RECORD,
            'attributes' => [
                'calculationOperation' => $this->calculationOperation->getValue(),
                'numberA' => $this->numberA,
                'numberB' => $this->numberB,
                'result' => $this->result,
            ],
        ];
    }
}
