<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class ProductController extends AbstractController
{
    #[Route('/categories/{id}/produits', name: 'app_product_list')]
    public function list(ProductRepository $repository, Category $category, Breadcrumbs $breadcrumbs): Response
    {
        $breadcrumbs->addItem($category->getName());

        $breadcrumbs->prependRouteItem("Catégories", "app_category_list");
        $breadcrumbs->prependRouteItem("Accueil", "app_home_home");


        // Je cherche les produits par catégories
         $products = $repository->findBy([
            'category' => $category,
         ]);

        // J'affiche la page de la liste des produits de la catégorie
        return $this->render('product/list.html.twig', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    #[Route('/produits/{id}', name: 'app_product_show')]
    public function show(Product $product, ProductRepository $repository, Breadcrumbs $breadcrumbs): Response
    {
        // Cette ligne permet d'ajouter un fil d'ariane dans la page pour savoir sur quel page nous sommes
        $breadcrumbs->addRouteItem($product->getName(), "app_product_show", ["id" => $product->getId()]);

        // Ces lignes permettent d'ajouter au fil d'ariane des item précédent le premier pour connaitre l'arborescence des pages et revenir à la précedente
        $breadcrumbs->prependRouteItem($product->getCategory()->getName(), "app_product_list", ["id" => $product->getCategory()->getId()]);
        $breadcrumbs->prependRouteItem("Catégories", "app_category_list");
        $breadcrumbs->prependRouteItem("Accueil", "app_home_home");

        //Permet de récupérer le produit
        $repository->find($product);

        // J'affiche la page du produit
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}