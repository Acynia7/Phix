<?php

namespace App\Controller\Admin;

use App\Entity\QuizState;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class QuizStateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizState::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Quiz State')
            ->setEntityLabelInPlural('Quizzes State')
            ->setSearchFields(['id'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('quizzes'))
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('quizzes');
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('state');
    }
}
