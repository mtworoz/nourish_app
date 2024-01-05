<?php

namespace App\Controller;

use App\Entity\Ebook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EbookController extends AbstractController
{

    #[Route('/ebook/{id}', name: 'ebook')]
    public function showEbook(Ebook $ebook)
    {
        return $this->render('elements/ebooks/cover.html.twig', [
            'ebook' => $ebook
        ]);
    }
}
