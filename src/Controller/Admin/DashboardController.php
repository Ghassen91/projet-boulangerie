<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\ImageBakery;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());


        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boulangerie de la gare');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour vers le site', 'fas fa-arrow-left', 'app_home_home');
        // yield MenuItem::section('Produits');
        yield MenuItem::subMenu('Produits')->setSubItems([
            MenuItem::linkToCrud('Ajouter un produit', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des produits', 'fas fa-eye', Product::class),
            // MenuItem::linkToCrud('Liste des images', 'fas fa-images', ImageProduct::class),
        ]);
        // yield MenuItem::section('Photos de la boulangerie');
        yield MenuItem::subMenu('Photos de la boulangerie')->setSubItems([
            MenuItem::linkToCrud('Ajouter une photo', 'fas fa-plus', ImageBakery::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des photos', 'fas fa-eye', ImageBakery::class)
        ]);
        // yield MenuItem::section('Catégories');
        yield MenuItem::subMenu('Catégories')->setSubItems([
            MenuItem::linkToCrud('Ajouter une catégorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des catégories', 'fas fa-eye', Category::class)
        ]);
    }
}