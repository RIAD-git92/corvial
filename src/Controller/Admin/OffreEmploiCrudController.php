<?php

namespace App\Controller\Admin;

use App\Entity\OffreEmploi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class OffreEmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffreEmploi::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextareaField::new('description'),
            MoneyField::new('salaire')->setCurrency('EUR')->setStoredAsCents(false),
            ChoiceField::new('contrat')
                ->setChoices([
                    'CDI' => OffreEmploi::CONTRAT_CDI,
                    'CDD' => OffreEmploi::CONTRAT_CDD,
                    'Interim' => OffreEmploi::CONTRAT_INTERIM,
                    'Stage' => OffreEmploi::CONTRAT_STAGE,
                    'Alternance' => OffreEmploi::CONTRAT_ALTERNANCE,
                ]),
            AssociationField::new('competences'),
            AssociationField::new('entreprise'),
        ];
    }
}
