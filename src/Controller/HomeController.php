<?php

namespace App\Controller;

use App\Form\ProductSearchType;
use App\Repository\ImageBakeryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_home')]
    public function home(ImageBakeryRepository $imageBakeryRepository): Response
    {
        // Permet de récuperer les photos de la boulangerie
        $imageBakerys = $imageBakeryRepository->findAll();
    
        // J'affiche la page d'accueil
        return $this->render('home/home.html.twig', [
            'imageBakerys' => $imageBakerys,
        ]);
    }

    #[Route('/rechercher', name: 'app_home_search')]
    public function search(ProductRepository $repository, Request $request): Response
    {
        // Je crée le formulaire de recherche
        $form = $this->createForm(ProductSearchType::class);

        //Je remplie le formulaire
        $form->handleRequest($request);

        // Je lance la recherche
        $products = $repository->findAllByCriteria($form->getData());

        // J'affiche la page de recherche
        return $this->render('home/search.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
}