<?php

namespace App\Twig\Runtime;

use App\Repository\CategoryRepository;
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
