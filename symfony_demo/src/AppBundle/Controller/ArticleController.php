<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 28/07/2015
 * Time: 22:28
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends Controller {

    /**
     * @Route("/articles")
     * @return Response
     */
    public function listAction() {
        $articles = array(
            array('title' => 'titre1', 'authorName' => 'Victor hugo', 'body' => 'corps de aticle'),
            array('title' => 'titre2', 'authorName' => 'Victor hugozi', 'body' => 'corps de aticle 2'),
            array('title' => 'titre3', 'authorName' => 'Roman polansky', 'body' => 'corps de aticle 3333333')
        );
        return $this->render('article/list.html.twig', array('articles' => $articles));
    }

}