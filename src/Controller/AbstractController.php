<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractController extends SymfonyAbstractController
{
    protected function jsonError(int $code, string $message, int $httpStatusCode = 400): JsonResponse
    {
        return $this->json([
            'code' => $code,
            'message' => $message
        ], $httpStatusCode);
    }
}
