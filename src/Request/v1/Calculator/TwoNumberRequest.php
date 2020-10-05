<?php
declare(strict_types=1);

namespace App\Request\v1\Calculator;

use App\Exception\Validation\ApiParameterConsistencyException;
use App\Request\RequestDTOInterface;
use App\Request\v1\ParameterTraits\NumberA;
use App\Request\v1\ParameterTraits\NumberB;
use App\Request\v1\ParameterTraits\ResultPrecision;
use App\Service\CalculatorService;
use Symfony\Component\HttpFoundation\Request;

final class TwoNumberRequest implements RequestDTOInterface
{
    use NumberA, NumberB, ResultPrecision;

    private const NUMBER_A = 'numberA';
    private const NUMBER_B = 'numberB';
    private const RESULT_PRECISION = 'resultPrecision';

    public function __construct(Request $request)
    {
        $body = json_decode($request->getContent(), true);
        if (!isset($body[static::NUMBER_A])) {
            throw new ApiParameterConsistencyException(static::NUMBER_A);
        }
        if (!isset($body[static::NUMBER_B])) {
            throw new ApiParameterConsistencyException(static::NUMBER_B);
        }

        $numberA = (string) $body[static::NUMBER_A];
        $numberB = (string) $body[static::NUMBER_B];
        $resultPrecision = $request->query->getInt(static::RESULT_PRECISION, CalculatorService::DEFAULT_RESULT_PRECISION);

        $this->setNumberA($numberA);
        $this->setNumberB($numberB);
        $this->setResultPrecision($resultPrecision);
    }
}
