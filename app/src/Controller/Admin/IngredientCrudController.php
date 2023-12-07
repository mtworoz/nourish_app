<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

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
            NumberField::new('kcalPer100g')
                ->setLabel('Kcal na 100g'),
            NumberField::new('Proteins')
                ->setLabel('Białko'),
            NumberField::new('Carbohydrates')
                ->setLabel('Węglowodany'),
            NumberField::new('Fats')
                ->setLabel('Tłuszcze'),
            ];


    }
}
