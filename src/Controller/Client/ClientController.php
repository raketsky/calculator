<?php
declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function home(Request $request): Response
    {
        return $this->renderTemplate('client');
    }

    private function renderTemplate(string $view, array $parameters = [], Response $response = null): Response
    {
        return parent::render($view.'.twig', $parameters, $response);
    }
}
