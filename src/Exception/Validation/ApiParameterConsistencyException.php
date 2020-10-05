<?php
declare(strict_types=1);

namespace App\Exception\Validation;

use App\DTO\ErrorJsonResponse;
use App\Exception\ApiException;

final class ApiParameterConsistencyException extends ApiException
{
    public function getApiErrorCode(): int
    {
        return ErrorJsonResponse::ERROR_PARAMETER_NOT_DEFINED_CORRECTLY_VALIDATION;
    }
}
