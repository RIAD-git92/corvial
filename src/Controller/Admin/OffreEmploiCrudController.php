<?php

namespace App\Controller\Admin;

use App\Entity\OffreEmploi;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OffreEmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffreEmploi::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('OffreEmploi')
            ->setEntityLabelInPlural('OffreEmplois')
            ->setPageTitle("index", "SimpleJob - Administration des Offres d'emplois")
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('titre'),
            AssociationField::new('entreprise'),
            TextareaField::new('description'),
            NumberField::new('salaire'),
        ];
    }

} 
