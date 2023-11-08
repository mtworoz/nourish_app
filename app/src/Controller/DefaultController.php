<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(CategoryRepository $categoryRepository) : Response
    {
        return $this->render('homepage.html.twig', ['categories' => $categoryRepository->findAll()]);
    }

}
