<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 27/07/2015
 * Time: 23:06
 */
class TemplatingController extends Controller
{

    /**
     * @Route("/templating")
     */
    public function indexAction() {
        return $this->render('templating/index.html.twig');
    }
}