<?php
namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\OffreEmploi;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(OffreEmploiRepository $offreEmploiRepository): Response
    {
        $offres = $offreEmploiRepository->findAll();
        // dd($offres);

        // Récupérer l'email de l'utilisateur connecté
        $userEmail = $this->getUser() ? $this->getUser()->getEmail() : null;

        return $this->render('home/index.html.twig', [
            'offres' => $offres,
            'userEmail' => $userEmail,
        ]);
    }

    #[Route('/nous-rejoindre', name: 'nous_rejoindre')]
    public function nousRejoindre(): Response
    {
        // Récupérer l'email de l'utilisateur connecté
        $userEmail = $this->getUser() ? $this->getUser()->getEmail() : null;

        return $this->render('home/nous_rejoindre.html.twig', [
            'userEmail' => $userEmail,
        ]);
    }

    #[Route("/apply-spontaneous", name: "apply_spontaneous")]
    public function applySpontaneous(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidature = new Candidature();
        $candidature->setEmail($request->request->get('email'));

        // Récupération des fichiers
        $cvFile = $request->files->get('cv');
        $letterFile = $request->files->get('letter');

        // Assurez-vous d'avoir configuré VichUploader pour ces champs dans l'entité
        $candidature->setCvFile($cvFile);
        $candidature->setLetterFile($letterFile);

        // Utilisation directe de l'EntityManager injecté
        $entityManager->persist($candidature);
        $entityManager->flush();

        // Ajout d'un message flash pour notifier l'utilisateur
        $this->addFlash('success', 'Votre candidature spontanée a été envoyée avec succès!');

        // Redirection vers la page d'accueil
        return $this->redirectToRoute('nous_rejoindre');
    }


    #[Route("/apply/{id}", name: "apply_to_offer")]
    public function applyToOffer(Request $request, OffreEmploi $offre, EntityManagerInterface $entityManager): Response
    {
        $candidature = new Candidature();
        $candidature->setOffreEmploi($offre);
        $candidature->setEmail($request->request->get('email'));

        // Récupération des fichiers
        $cvFile = $request->files->get('cv');
        $letterFile = $request->files->get('letter');

        // Assurez-vous d'avoir configuré VichUploader pour ces champs dans l'entité
        $candidature->setCvFile($cvFile);
        $candidature->setLetterFile($letterFile);

        // Utilisation directe de l'EntityManager injecté
        $entityManager->persist($candidature);
        $entityManager->flush();

        // Ajout d'un message flash pour notifier l'utilisateur
        $this->addFlash('success', 'Votre candidature a été envoyée avec succès!');

        // Redirection vers la page d'accueil
        return $this->redirectToRoute('nous_rejoindre');
    }
}
