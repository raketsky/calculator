<?php
declare(strict_types=1);

namespace App\Exception;

use App\DTO\ErrorJsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiException extends BadRequestHttpException implements AppExceptionInterface
{
    public function __construct(string $message, \Throwable $previous = null, int $code = 400, array $headers = [])
    {
        $message = sprintf(ErrorJsonResponse::getErrorMsgByCode($this->getApiErrorCode()), $message);

        parent::__construct($message, $previous, $code, $headers);
    }

    public function getApiErrorCode(): int
    {
        return ErrorJsonResponse::ERROR_GENERIC;
    }
}
