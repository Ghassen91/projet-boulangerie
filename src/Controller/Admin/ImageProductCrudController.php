<?php

namespace App\Controller\Admin;

use App\Entity\ImageProduct;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class ImageProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageProduct::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('imageName')->setBasePath('/images/products/')->onlyOnIndex(),
            DateTimeField::new('createdAt'),
            DateTimeField::new('updatedAt'),
        ];
    }

     /**
     * Cette fonction est une méthode de AbstractController et nous permet de set updatedAt au moment de ma mise a jour du produit
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof ImageProduct) return;

        $entityInstance->setUpdatedAt(new DateTime());

        parent::updateEntity($entityManager, $entityInstance);
    }
}