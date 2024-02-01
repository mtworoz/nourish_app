<?php

namespace App\UI\Controller;

use App\Application\Service\Ebook\EbookExportService;
use App\Domain\Repository\Ebook\EbookRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EbookController extends AbstractController
{
    public function __construct(
        private EbookExportService $ebookExportService,
        private EbookRepositoryInterface $ebookRepository
    )
    {
    }

    #[Route('/ebook/{id}', name: 'ebook')]
    public function showEbook(int $id): Response
    {
        $ebook = $this->ebookRepository->find($id);

        if (!$ebook) {
            throw $this->createNotFoundException('Ebook not found');
        }

        $this->ebookExportService->exportEbookToPdf($ebook);

        return new Response('ok');
    }
}
