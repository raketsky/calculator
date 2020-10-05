<?php
declare(strict_types=1);

namespace App\DTO;

use App\Entity\CalculationRecord;
use App\Exception\UnexpectedClassException;

class CalculationRecordResourceCollection
{
    /**
     * @var CalculationRecordResource[]
     */
    private array $items = [];

    /**
     * @param CalculationRecord[] $collectionRecords
     */
    public function __construct(array $collectionRecords) {
        foreach ($collectionRecords as $collectionRecord) {
            if (!$collectionRecord instanceof CalculationRecord) {
                throw new UnexpectedClassException(CalculationRecord::class, $collectionRecord);
            }
            $this->items[] = new CalculationRecordResource($collectionRecord);
        }
    }

    public function getJsonItemResponse(): array
    {
        $collection = [];
        foreach ($this->items as $item) {
            $collection[] = $item->getJsonItemResponse();
        }

        return $collection;
    }
}
