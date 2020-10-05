<?php
declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

final class DocController extends AbstractController
{
    private const SWAGGER_FILE = 'doc_v1.yaml';

    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Route("/api/v1/doc.{fileType}", methods={"GET"}, requirements={"fileType": "json|yaml"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function apiDoc(Request $request): Response
    {
        $fileType = $request->attributes->get('fileType');
        $path = $this->getDocPath();
        if (!file_exists($path)) {
            throw new NotFoundHttpException();
        }

        if ('json' === $fileType) {
            $data = Yaml::parseFile($path);

            return new JsonResponse($data);
        } else {
            $data = file_get_contents($path);

            return new Response($data);
        }
    }

    private function getDocPath(): string
    {
        return sprintf('%s/%s', $this->kernel->getProjectDir(), static::SWAGGER_FILE);
    }
}
