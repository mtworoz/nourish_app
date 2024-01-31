<?php

namespace App\Application\Service\Ebook;

use App\Domain\Entity\Ebook\Ebook;
use Knp\Snappy\Pdf;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class EbookExportService
{
    private Pdf $pdf;
    private Filesystem $filesystem;
    private KernelInterface $kernel;
    private Environment $twig;

    public function __construct(Pdf $pdf, Filesystem $filesystem, KernelInterface $kernel, Environment $twig)
    {
        $this->pdf = $pdf;
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
        $this->twig = $twig;
    }

    public function exportEbookToPdf(Ebook $ebook): void
    {
        $html = $this->twig->render('elements/ebooks/cover.html.twig', [
            'ebook' => $ebook
        ]);

        $projectPath = $this->kernel->getProjectDir();
        $targetDirectory = $projectPath . '/public/ebooks';
        $pdf = $this->pdf->getOutputFromHtml($html);
        $fileName = 'nazwa_pliku.pdf';
        $targetFilePath = $targetDirectory . '/' . $fileName;

        if (!$this->filesystem->exists($targetDirectory)) {
            $this->filesystem->mkdir($targetDirectory);
        }

        $this->filesystem->dumpFile($targetFilePath, $pdf);
    }
}
