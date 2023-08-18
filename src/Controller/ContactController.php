<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_contact')]
    public function contact(
    Request $request, 
    MailerService $mailer, 
    ContactRepository $repository, 
    Breadcrumbs $breadcrumbs, 
    ): Response
    {
        $breadcrumbs->addItem("Contact");

        $breadcrumbs->prependRouteItem("Accueil", "app_home_home");

        //je crée le formulaire
        $form = $this->createForm(ContactType::class);

        //Je rempli le formulaire
        $form->handleRequest($request);

        //On verifie la validité du formulaire
        if($form->isSubmitted() && $form->isValid()){
            //Je récupère les données saisies
            $contact = $form->getData();

            $to = "contact@boulangerie-de-la-gare.fr";
            
            $from = $contact->getEmail();
            $replyTo = $contact->getEmail();
            $subject = 'Nouveau message de '.' '.$contact->getName(). ' '.$contact->getFirstname();
            $content = $contact->getMessage();
            // J'utilise le mailerService pour envoyer ce formulaire
            // à l'adresse mail de l'administrateur
            $mailer->sendEmail($replyTo, $to, $subject, $content, $from);

            // Si le formulaire est bien envoyer et le mail est correctement envoyé
            // j'affiche un meesage de succès à l'utilisateur
            $this->addFlash('success', 'Votre message a été envoyé');

            // J'enregistre les données saisies en base de données
            $repository->save($contact, true);

            // Je redirige vers le page de contact
            return $this->redirectToRoute('app_contact_contact');
        }


        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}