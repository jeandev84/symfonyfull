<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;





/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     * @param GiftsService $gifts
     * @param Request $request
     * @return Response
     */
    public function index(GiftsService $gifts, Request $request)
    {
       $users = $this->getDoctrine()
                     ->getRepository(User::class)
                     ->findAll();

       # GET
       /* if it does not defined parameter page, we will get default value http://127.0.0.1:8000/?page=10 => 10 */
       /* if it does not defined parameter page, we will get default value http://127.0.0.1:8000/ => default */
       // exit($request->query->get('page', 'default'));


       # POST
       # exit($request->server->get('HTTP_POST'));

       # is AJAX ( xmlRequest ) [ boolean ]
       $request->isXmlHttpRequest();

       $request->request->get('page');

       # Get Uploaded Files
       $request->files->get('foo');

       return $this->render('default/index.html.twig', [
           'controller_name' => 'DefaultController',
           'users' => $users,
           'random_gift' => $gifts->gifts
       ]);
    }

}
