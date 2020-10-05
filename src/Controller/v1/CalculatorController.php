<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractController;
use App\DTO\CalculationRecordResource;
use App\Entity\CalculationRecord;
use App\Request\v1\Calculator\TwoNumberRequest;
use App\Service\CalculationRecordService;
use App\Service\CalculatorService;
use App\ValueObject\CalculationOperation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CalculatorController extends AbstractController
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
     * @Route("/api/v1/add", methods={"POST"})
     *
     * @param TwoNumberRequest $request
     * @return JsonResponse
     */
    public function calculateAdd(TwoNumberRequest $request): JsonResponse
    {
        $calculationRecord = $this->calculationRecordService->createNewFromRequest($request, CalculationOperation::OPERATION_ADD);
        $resultValue = $this->calculatorService->add($request->getNumberA(), $request->getNumberB(), $request->getResultPrecision());
        $this->calculationRecordService->setResultValue($calculationRecord, $resultValue);

        return $this->jsonCalculationRecord($calculationRecord);
    }

    /**
     * @Route("/api/v1/sub", methods={"POST"})
     *
     * @param TwoNumberRequest $request
     * @return JsonResponse
     */
    public function calculateSub(TwoNumberRequest $request): JsonResponse
    {
        $calculationRecord = $this->calculationRecordService->createNewFromRequest($request, CalculationOperation::OPERATION_SUB);

        $resultValue = $this->calculatorService->sub($request->getNumberA(), $request->getNumberB(), $request->getResultPrecision());

        $this->calculationRecordService->setResultValue($calculationRecord, $resultValue);

        return $this->jsonCalculationRecord($calculationRecord);
    }

    /**
     * @Route("/api/v1/div", methods={"POST"})
     *
     * @param TwoNumberRequest $request
     * @return JsonResponse
     */
    public function calculateDiv(TwoNumberRequest $request): JsonResponse
    {
        $calculationRecord = $this->calculationRecordService->createNewFromRequest($request, CalculationOperation::OPERATION_DIV);

        $resultValue = $this->calculatorService->div($request->getNumberA(), $request->getNumberB(), $request->getResultPrecision());

        $this->calculationRecordService->setResultValue($calculationRecord, $resultValue);

        return $this->jsonCalculationRecord($calculationRecord);
    }

    /**
     * @Route("/api/v1/mul", methods={"POST"})
     *
     * @param TwoNumberRequest $request
     * @return JsonResponse
     */
    public function calculateMul(TwoNumberRequest $request): JsonResponse
    {
        $calculationRecord = $this->calculationRecordService->createNewFromRequest($request, CalculationOperation::OPERATION_MUL);
        $resultValue = $this->calculatorService->mul($request->getNumberA(), $request->getNumberB(), $request->getResultPrecision());
        $this->calculationRecordService->setResultValue($calculationRecord, $resultValue);

        return $this->jsonCalculationRecord($calculationRecord);
    }

    private function jsonCalculationRecord(CalculationRecord $calculationRecord): JsonResponse
    {
        $calculationRecord = new CalculationRecordResource($calculationRecord);

        return $this->json([
            'data' => $calculationRecord->getJsonItemResponse(),
        ]);
    }
}
