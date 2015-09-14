<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 28/07/2015
 * Time: 22:28
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Locale\Locale;


class ArticleController extends Controller {

    /**
     * @Route("/articles")
     * @return Response
     */
    public function listAction(Request $_request)
    {

        $author = new Author();
//        $author->name = 'bbbbbbbb';

        // ... do something to the $author object

        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }

        $articles = array(
            array('title' => 'titre1', 'authorName' => 'Victor hugo', 'body' => 'corps de aticle'),
            array('title' => 'titre2', 'authorName' => 'Victor hugozi', 'body' => 'corps de aticle 2'),
            array('title' => 'titre3', 'authorName' => 'Roman polansky', 'body' => 'corps de aticle 3333333')
        );
        return $this->render('article/list.html.twig', array('articles' => $articles));
    }

    public function recentArticlesAction($max = 3)
    {
        $articles = array(
            array('slug'=>'1', 'title' => 'recent article 1', 'authorName' => 'Victor hugo', 'body' => 'corps de aticle'),
            array('slug'=>'2', 'title' => 'recent article 2', 'authorName' => 'Victor hugozi', 'body' => 'corps de aticle 2'),
        );

        return $this->render('article/recent_list.html.twig', array('articles' => $articles)
        );
    }

    /**
     * @Route("/article/{slug}")
     * @param $slug
     */
    public function showAction($slug)
    {

    }
}