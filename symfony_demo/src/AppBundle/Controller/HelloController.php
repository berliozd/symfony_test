<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class HelloController extends Controller {

    /**
     * @Route("/hello/{name}")
     */
    public function indexAction($name, Request $request) {


//        var_dump(get_class_methods(get_class($this)));exit;
        $uri = $this->generateUrl('app_blog_show', array(
            'year' => '2013',
            'title' => 'titre boo',
            '_locale' => 'fr'

        ), true);
//        var_dump($uri);exit;

        /** @var \Symfony\Component\HttpFoundation\Session\Session $session  */
        $session = $request->getSession();

//        var_dump(get_class($session));exit;
//
//        $foo = $session->get('foo');
//        var_dump($foo);exit;


//        $homepageUrl = $this->generateUrl('homepage');
//        return $this->redirect($homepageUrl);

//        return $this->redirectToRoute('homepage');



//        var_dump($session->getFlashBag()->get('notice'));
        
        $page = $request->query->get('page', 1);

//        return new Response('<html><body>Hello ' . $name . '! => ' . $page . '</body></html>');

        return $this->render('hello/index.html.twig', array('name' => $name));
//        return $this->render('AppBundle:hello:index.html.twig', array('name' => $name));

    }
}