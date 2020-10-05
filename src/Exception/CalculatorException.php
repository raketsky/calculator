<?php
declare(strict_types=1);

namespace App\Exception;

use App\DTO\ErrorJsonResponse;

final class CalculatorException extends ApiException implements AppExceptionInterface
{
    public function getErrorCode()
    {
        return ErrorJsonResponse::ERROR_CALCULATOR;
    }
}
