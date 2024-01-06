<?php

namespace App\Controller;

use App\Entity\Ebook;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class EbookController extends AbstractController
{

    private Environment $twig;
    private Pdf $pdf;
    private Filesystem $filesystem;

    public function __construct(Environment $twig, Pdf $pdf, Filesystem $filesystem)
    {
        $this->twig = $twig;
        $this->pdf = $pdf;
        $this->filesystem = $filesystem;
    }

    #[Route('/ebook/{id}', name: 'ebook')]
    public function showEbook(Ebook $ebook, KernelInterface $kernel)
    {
        $html = $this->twig->render('elements/ebooks/cover.html.twig', [
            'ebook' => $ebook
        ]);

        $projectPath = $kernel->getProjectDir();

        $targetDirectory = $projectPath . '/public/ebooks';

        $pdf = $this->pdf->getOutputFromHtml($html);

        $fileName = 'nazwa_pliku.pdf';

        $targetFilePath = $targetDirectory . '/' . $fileName;

        if (!$this->filesystem->exists($targetDirectory)) {
            $this->filesystem->mkdir($targetDirectory);
        }

        $this->filesystem->dumpFile($targetFilePath, $pdf);

        return new Response('ok');
    }

}
