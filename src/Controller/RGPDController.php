<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RGPDController extends AbstractController
{
    #[Route('/mentions-legales', name: 'mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('rgpd/mentions_legales.html.twig');
    }

    #[Route('/politique-de-confidentialite', name: 'politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('rgpd/politique_confidentialite.html.twig');
    }

    #[Route('/conditions-generales-utilisation', name: 'cgu')]
    public function conditionsGeneralesUtilisation(): Response
    {
        return $this->render('rgpd/cgu.html.twig');
    }

    #[Route('/conditions-generales-vente', name: 'cgv')]
    public function conditionsGeneralesVente(): Response
    {
        return $this->render('rgpd/cgv.html.twig');
    }

    #[Route('/politique-des-cookies', name: 'politique_cookies')]
    public function politiqueCookies(): Response
    {
        return $this->render('rgpd/politique_cookies.html.twig');
    }
}
 