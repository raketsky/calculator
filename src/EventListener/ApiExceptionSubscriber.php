<?php
declare(strict_types=1);

namespace App\EventListener;

use App\DTO\ErrorJsonResponse;
use App\Exception\AppExceptionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private string $env = 'dev';

//    public function __construct(string $env)
//    {
//        $this->env = $env;
//    }

    public function onExceptionEvent(ExceptionEvent $event): void
    {
//        if ($this->env === 'dev') {
//            return;
//        }

        $exception = $event->getThrowable();
        if ($exception instanceof AppExceptionInterface) {
            $errorVO = new ErrorJsonResponse($exception->getApiErrorCode(), Response::HTTP_BAD_REQUEST, $exception->getMessage());
        } else {
            $errorVO = new ErrorJsonResponse(ErrorJsonResponse::ERROR_GENERIC, Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        $event->setResponse($errorVO->getResponse());
    }

    public static function getSubscribedEvents()
    {
        return [
            ExceptionEvent::class => 'onExceptionEvent',
        ];
    }
}
