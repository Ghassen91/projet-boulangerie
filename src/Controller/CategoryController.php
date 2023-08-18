<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Services\BreadcrumbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_category_list')]
    public function list(Category $categorys, CategoryRepository $repository, Breadcrumbs $breadcrumbs): Response
    {
        $breadcrumbs->addItem("Catégories");

        $breadcrumbs->prependRouteItem("Accueil", "app_home_home");

        $categorys = $repository->findAll();
        
        return $this->render('category/list.html.twig', [
            'categorys' => $categorys,
        ]);
    }
}