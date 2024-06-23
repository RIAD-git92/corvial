<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CandidatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des candidatures')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une candidature')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier une candidature')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails de la candidature')
            ->setEntityLabelInSingular('Candidature')
            ->setEntityLabelInPlural('Candidatures');
    }
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('offreEmploi');
        yield Field::new('email');
        yield ImageField::new('cv_name')
            ->setBasePath('/uploads/cvs')
            ->setUploadDir('public/uploads/cvs')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);
        yield ImageField::new('letter_name')
            ->setBasePath('/uploads/letters')
            ->setUploadDir('public/uploads/letters')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false);

    }
}
