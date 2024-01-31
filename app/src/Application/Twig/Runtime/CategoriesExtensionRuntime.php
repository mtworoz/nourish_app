<?php

namespace App\Application\Twig\Runtime;

use App\Infrastructure\Repository\Blog\CategoryRepository;
use Twig\Extension\RuntimeExtensionInterface;

class CategoriesExtensionRuntime implements RuntimeExtensionInterface
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getRecipesCategories(): array
    {
        return $this->categoryRepository->findAll();
    }
}
