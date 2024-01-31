<?php

namespace App\UI\Controller\Admin;

use App\Domain\Entity\Recipe\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud
            ->setPageTitle('index', 'Składniki')
            ->setPageTitle('new', 'Nowy składnik')
            ->setPageTitle('edit', 'Edytuj składnik');

        return $crud;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nazwa'),
            NumberField::new('kcalPer100g')
                ->setLabel('Kcal na 100g')
                ->setRequired(true),
            NumberField::new('Proteins')
                ->setLabel('Białko')
                ->setRequired(true),
            NumberField::new('Carbohydrates')
                ->setLabel('Węglowodany')
                ->setRequired(true),
            NumberField::new('Fats')
                ->setLabel('Tłuszcze')
                ->setRequired(true),
            ];


    }
}
