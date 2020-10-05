<?php
declare(strict_types=1);

namespace App\Exception\Validation;

use App\DTO\ErrorJsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ApiValidationException extends BadRequestHttpException implements ApiValidationExceptionInterface
{
    /**
     * @var ConstraintViolationListInterface
     */
    private ConstraintViolationListInterface $errors;

    public function __construct(ConstraintViolationListInterface $errors, \Throwable $previous = null, int $code = 400, array $headers = [])
    {
        $this->errors = $errors;

        parent::__construct(
            sprintf(ErrorJsonResponse::getErrorMsgByCode($this->getApiErrorCode()), $this->formatMessageString($errors)),
            $previous, $code, $headers
        );
    }

    private function formatMessageString(ConstraintViolationListInterface $errors): string
    {
        $message = [];
        /**
         * @var ConstraintViolationInterface $error
         */
        foreach ($errors as $error) {
            $message[] = sprintf('%s - %s', $error->getPropertyPath(), $error->getMessage());
        }

        return trim(implode('; ', $message));
    }

    public function getApiErrorCode(): int
    {
        return ErrorJsonResponse::ERROR_CONSTRAINT_VALIDATION;
    }
}
