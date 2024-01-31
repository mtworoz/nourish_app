<?php

namespace App\UI\Controller\Admin;

use App\Domain\Entity\Ebook\Chapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
                ->setLabel('Tytuł'),
            AssociationField::new('recipes')
                ->setLabel('Przepisy')
        ];
    }

}
