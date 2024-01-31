<?php

namespace App\UI\Controller;

use App\Application\Service\Ebook\EbookExportService;
use App\Domain\Entity\Ebook\Ebook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EbookController extends AbstractController
{
    public function __construct(private EbookExportService $ebookExportService)
    {
    }

    #[Route('/ebook/{id}', name: 'ebook')]
    public function showEbook(Ebook $ebook): Response
    {
        $this->ebookExportService->exportEbookToPdf($ebook);

        return new Response('ok');
    }
}
