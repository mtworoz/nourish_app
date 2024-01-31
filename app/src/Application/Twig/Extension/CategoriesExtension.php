<?php

namespace App\Application\Twig\Extension;

use App\Application\Twig\Runtime\CategoriesExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CategoriesExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getRecipesCategories', [CategoriesExtensionRuntime::class, 'getRecipesCategories']),
        ];
    }
}
