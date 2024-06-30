<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookieController extends AbstractController
{
    #[Route('/set-cookie', name: 'set_cookie')]
    public function setCookie(Request $request): Response
    {
        $response = new Response();
        
        // Créer un cookie avec une durée de vie de 1 heure
        $cookie = Cookie::create('my_cookie')
            ->withValue('cookie_value')
            ->withExpires(time() + 3600)
            ->withSecure(true)
            ->withHttpOnly(true)
            ->withSameSite(Cookie::SAMESITE_STRICT);

        $response->headers->setCookie($cookie);
        $response->send();

        return $this->render('cookie/set_cookie.html.twig');
    }

    #[Route('/get-cookie', name: 'get_cookie')]
    public function getCookie(Request $request): Response
    {
        $cookieValue = $request->cookies->get('my_cookie');

        return $this->render('cookie/get_cookie.html.twig', [
            'cookie_value' => $cookieValue,
        ]);
    }
}
