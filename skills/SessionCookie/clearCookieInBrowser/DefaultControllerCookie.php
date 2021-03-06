<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;



/**
 * Class DefaultControllerCookie
 * @package App\Controller
 */
class DefaultControllerCookie extends AbstractController
{

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @return Response
     */
    public function index(GiftsService $gifts)
    {
        # Get users from repository
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        # Cookie
        $cookie = new Cookie(
            'my_cookie', // Cookie name
            'cookie_value', // Cookie value
            time() + (2 * 365 * 24 * 60 * 60) // Expires after 2 years
        );

        # Send cookie to the browser
        /*
        $res = new Response();
        $res->headers->setCookie($cookie);
        $res->send();
        */

        # Clear cookie in the browser
        $res = new Response();
        $res->headers->clearCookie('my_cookie');
        $res->send();

        # render the view
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts
        ]);
    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     * This {page?} mean that parameter "page' is optional parameter
     *
     * Example path: /blog
     */
    public function index2()
    {
        return new Response('Optional parameters in url and requirements for parameters');
    }

    /**
     * @Route(
     *   "/articles/{_locale}/{year}/{slug}/{category}",
     *   defaults={"category": "computers"},
     *   requirements={
     *     "_locale": "en|fr",
     *     "category": "computers|rtv",
     *     "year": "\d+"
     *  }
     * )
     *
     * Example path :
     *  /articles/en/2019/dell/computers
     *  /articles/en/2019/dell/rtv
     */
    public function index3()
    {
        return new Response('An Advanced route example');
    }



    /**
     * @Route({
     *   "nl" : "/over-ons",
     *   "en" : "/about-us"
     *  }, name="about_us"
     * )
     *
     */
    public function index4()
    {
        return new Response('Translated routes');
    }
}
