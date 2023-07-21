<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController
{
    #[Route('/catégories', name: 'app_category_list')]
    public function list(Category $categorys, CategoryRepository $repository): Response
    {
        $categorys = $repository->findAll();
        
        return $this->render('category/list.html.twig', [
            'categorys' => $categorys,
        ]);
    }
}