<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/categories/{id}/produits', name: 'app_product_list')]
    public function list(ProductRepository $repository, Category $category): Response
    {
        // Je cherche les produits par catégories
         $products = $repository->findBy([
            'category' => $category,
         ]);

        // J'affiche la page de la liste des produits de la catégorie
        return $this->render('product/list.html.twig', [
            'products' => $products,
            'category' => $category
        ]);
    }

    #[Route('/produits/{id}', name: 'app_product_show')]
    public function show(Product $product, ProductRepository $repository): Response
    {
        //Permet de récupérer le produit
        $repository->find($product);

        // J'affiche la page du produit
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}