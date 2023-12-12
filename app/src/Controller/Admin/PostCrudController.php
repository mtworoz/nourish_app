<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }


    public function createEntity(string $entityFqcn)
    {
        $entity = parent::createEntity($entityFqcn);

        if ($entity instanceof Post){
            $entity->setDate(new \DateTime());
        }

        return $entity;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud
            ->setFormThemes([
                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig'
            ])
            ->setPageTitle('index', 'Posty')
            ->setPageTitle('new', 'Nowy post')
            ->setPageTitle('edit', 'Edytuj post');

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex()
                ->setLabel('ID'),
            Field::new('date')
                ->onlyOnIndex()
                ->setLabel('Data dodania'),
            TextField::new('title')
                ->setLabel('Tytuł'),
            CKEditorField::new('content')
                ->setLabel('Treść'),
            ImageField::new('image')
                ->setUploadDir('public/post_images')
                ->setBasePath('post_images'),
            AssociationField::new('recipes')
                ->onlyOnForms()
                ->autocomplete()
                ->setLabel('Przepisy')
                ->setFormTypeOption('multiple', true)
                ->setFormTypeOption('by_reference', false),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewOnSiteAction = Action::new('viewOnSite', 'Zobacz na stronie', 'fa fa-eye')
            ->linkToRoute('single_post', function (Post $post) {
                return [
                    'id' => $post->getId()
                ];
            });

        return parent::configureActions($actions)
            ->add(Crud::PAGE_EDIT, $viewOnSiteAction);
    }

}

