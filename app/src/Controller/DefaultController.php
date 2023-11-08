<?php

namespace App\Controller;

use App\Service\ApiIngredientsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(ApiIngredientsService $apiIngredientsService) : Response
    {
        return $apiIngredientsService->get();
    }

}
