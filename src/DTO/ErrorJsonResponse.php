<?php
declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorJsonResponse
{
    public const ERROR_GENERIC = 110;
    public const ERROR_CALCULATOR = 120;
    public const ERROR_CONSTRAINT_VALIDATION = 130;
    public const ERROR_PARAMETER_NOT_DEFINED_CORRECTLY_VALIDATION = 131;

    public const ERROR_MSG_GENERIC = 'Error "%s"';
    public const ERROR_MSG_CALCULATOR = 'Calculator error "%s"';
    public const ERROR_MSG_CONSTRAINT_VALIDATION = 'Constraint validation errors: %s';
    public const ERROR_MSG_PARAMETER_NOT_DEFINED_CORRECTLY_VALIDATION = 'Parameter "%s" have not defined well';

    private const ERRORS_MESSAGES = [
        self::ERROR_GENERIC => self::ERROR_MSG_GENERIC,
        self::ERROR_CALCULATOR => self::ERROR_MSG_CALCULATOR,
        self::ERROR_CONSTRAINT_VALIDATION => self::ERROR_MSG_CONSTRAINT_VALIDATION,
        self::ERROR_PARAMETER_NOT_DEFINED_CORRECTLY_VALIDATION => self::ERROR_MSG_PARAMETER_NOT_DEFINED_CORRECTLY_VALIDATION,
    ];

    private JsonResponse $response;

    public function __construct(int $errorCode, int $status = Response::HTTP_BAD_REQUEST, string $detail = null)
    {
        $this->response = new JsonResponse([
            'code' => $errorCode,
            'message' => $detail ?? $this->getErrorMsgByCode($errorCode),
        ], $status);
    }

    public function getResponse(): JsonResponse
    {
        return $this->response;
    }

    public static function getErrorMsgByCode(int $code): ?string
    {
        if (!isset(static::ERRORS_MESSAGES[$code])) {
            return null;
        }

        return static::ERRORS_MESSAGES[$code];
    }
}
