<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ImageProductType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
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
            IdField::new('id')->hideOnForm(), // hideOnForm sert à cacher ce champs
            TextField::new('name', 'Nom'),
            NumberField::new('price', 'Prix')->setNumDecimals(2),
            AssociationField::new('category', 'Catégorie'),
            TextareaField::new('description', 'Description'),
            CollectionField::new('images')->setEntryType(ImageProductType::class),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

    /**
     * Cette fonction est une méthode de AbstractController et nous permet de set updatedAt au moment de ma mise a jour du produit
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setUpdatedAt(new DateTime());

        parent::updateEntity($entityManager, $entityInstance);
    }

}