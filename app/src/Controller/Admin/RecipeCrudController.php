<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud->setFormThemes([
            '@FOSCKEditor/Form/ckeditor_widget.html.twig',
            '@EasyAdmin/crud/form_theme.html.twig'
        ]);

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            CKEditorField::new('instruction'),
            NumberField::new('preparationTime'),
        ];
    }
}
