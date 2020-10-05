<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractController;
use App\DTO\CalculationRecordResourceCollection;
use App\Entity\CalculationRecord;
use App\Request\v1\History\HistoryRequest;
use App\Service\CalculationRecordService;
use App\Service\CalculatorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HistoryController extends AbstractController
{
    private CalculatorService $calculatorService;
    private CalculationRecordService $calculationRecordService;

    public function __construct(
        CalculatorService $calculatorService,
        CalculationRecordService $calculationRecordService
    ) {
        $this->calculatorService = $calculatorService;
        $this->calculationRecordService = $calculationRecordService;
    }

    /**
     * @Route("/api/v1/history", methods={"GET"})
     *
     * @param HistoryRequest $request
     * @return JsonResponse
     */
    public function findLast(HistoryRequest $request): JsonResponse
    {
        $lastHistoryRecords = $this->calculationRecordService->findLast($request->getLimit());

        return $this->jsonCalculationRecords($lastHistoryRecords);
    }

    /**
     * @param CalculationRecord[] $calculationRecords
     * @return JsonResponse
     */
    private function jsonCalculationRecords(array $calculationRecords): JsonResponse
    {
        $calculationRecordsCollection = new CalculationRecordResourceCollection($calculationRecords);

        return $this->json([
            'data' => $calculationRecordsCollection->getJsonItemResponse(),
        ]);
    }
}
