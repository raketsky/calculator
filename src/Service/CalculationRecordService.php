<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\CalculationRecord;
use App\Repository\CalculationRecordRepository;
use App\Request\v1\Calculator\TwoNumberRequest;
use App\ValueObject\CalculationOperation;

class CalculationRecordService
{
    private CalculationRecordRepository $calculationRecordRepository;

    public function __construct(CalculationRecordRepository $calculationRecordRepository)
    {
        $this->calculationRecordRepository = $calculationRecordRepository;
    }

    public function createNewFromRequest(TwoNumberRequest $request, string $calculationOperationKey): CalculationRecord
    {
        $calculationOperation = new CalculationOperation($calculationOperationKey);

        $calculationRecord = new CalculationRecord();
        $calculationRecord->setNumberA($request->getNumberA());
        $calculationRecord->setNumberB($request->getNumberB());
        $calculationRecord->setNumberB($request->getNumberB());
        $calculationRecord->setCalculationOperation($calculationOperation);

        $this->calculationRecordRepository->add($calculationRecord);

        return $calculationRecord;
    }

    public function setResultValue(CalculationRecord $calculationRecord, string $resultValue): void
    {
        $calculationRecord->setResultValue($resultValue);
        $calculationRecord->setUpdatedAt(new \DateTimeImmutable());

        $this->calculationRecordRepository->update($calculationRecord);
    }

    /**
     * @param int $limit
     * @return CalculationRecord[]
     */
    public function findLast(int $limit): array
    {
        return $this->calculationRecordRepository->findLast($limit);
    }
}
