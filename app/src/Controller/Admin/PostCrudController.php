<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Post;
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
        $crud->setFormThemes([
            '@FOSCKEditor/Form/ckeditor_widget.html.twig',
            '@EasyAdmin/crud/form_theme.html.twig'
        ]);

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('date')->onlyOnIndex(),
            TextField::new('title'),
            CKEditorField::new('content'),
            AssociationField::new('recipes')
                ->onlyOnForms()
                ->autocomplete(),
            ImageField::new('image')
                ->setUploadDir('public/post_images')
                ->setBasePath('post_images')

        ];
    }

}

