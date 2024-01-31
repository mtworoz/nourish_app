<?php

namespace App\UI\Controller\Admin;

use App\Domain\Entity\Ebook\Ebook;
use App\UI\Admin\Field\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EbookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ebook::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud
            ->setFormThemes([
                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig'
            ])
            ->setPageTitle('index', 'Ebooki')
            ->setPageTitle('new', 'Nowy ebook')
            ->setPageTitle('edit', 'Edytuj ebook');

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex()
                ->setLabel('ID'),
            TextField::new('title')
                ->setLabel('Tytuł'),
            CKEditorField::new('description')
                ->setLabel('Opis'),
            ImageField::new('image')
                ->setUploadDir('public/ebook_covers')
                ->setBasePath('ebook_covers'),
            CollectionField::new('chapters')
                ->useEntryCrudForm()
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
                ->setLabel('Rozdziały')
                ->setColumns(12)
                ->allowAdd()
        ];
    }
}
