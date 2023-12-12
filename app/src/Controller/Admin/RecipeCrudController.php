<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
        $crud
            ->setFormThemes([
                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig'
            ])
            ->setPageTitle('index', 'Przepisy')
            ->setPageTitle('new', 'Nowy przepis')
            ->setPageTitle('edit', 'Edytuj przepis');

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('title')
                ->setLabel('Tytuł')
                ->setColumns(12),
            CKEditorField::new('instruction')
                ->setLabel('Instrukcja')
                ->setColumns(12),
            NumberField::new('preparationTime')
                ->setLabel('Czas przygotowania')
                ->setColumns(8),
            NumberField::new('servings')
                ->setLabel('Porcje')
                ->hideOnIndex(),
            AssociationField::new('categories')
                ->setLabel('Kategorie')
                ->setColumns(12)
                ->setFormTypeOption('multiple', true)
                ->setFormTypeOption('by_reference', false),
            CollectionField::new('recipeIngredients')
                ->useEntryCrudForm()
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
                ->setLabel('Składniki')
                ->setColumns(12)
                ->allowAdd()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewOnSiteAction = Action::new('viewOnSite', 'Zobacz na stronie', 'fa fa-eye')
            ->linkToRoute('single_post', function (Recipe $recipe) {
                if ($recipe->getPost() !== null) {
                    return [
                        'id' => $recipe->getPost()->getId(),
                    ];
                }
                return null;
            })
            ->displayIf(function (Recipe $recipe) {
                return $recipe->getPost() !== null;
            });
        return parent::configureActions($actions)
            ->add(Crud::PAGE_EDIT, $viewOnSiteAction);
    }
}
