<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RgpdController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_rgpd_legalNotice')]
    public function legalNotice(): Response
    {
        return $this->render('rgpd/legalNotice.html.twig');
    }


    #[Route('/politique-de-confidentialite', name: 'app_rgpd_confidentialityPolicy')]
    public function confidentialityPolicy(): Response
    {
        return $this->render('rgpd/confidentialityPolicy.html.twig');
    }
}