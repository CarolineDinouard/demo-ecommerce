<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
          TextField::new('name', 'Nom'),
          SlugField::new('slug', 'Url')->setTargetFieldName('name'),
          ImageField::new('illustration')
              ->setBasePath('uploads/')
              ->setUploadDir('public/uploads/')
              ->setUploadedFileNamePattern('[randomhash].[extension]')
              ->setRequired(false),
          TextField::new('subtitle', 'Description courte'),
          TextareaField::new('description'),
          MoneyField::new('price', 'Prix')->setCurrency('EUR'),
          AssociationField::new('category', 'Catégorie')
        ];
    }
}
