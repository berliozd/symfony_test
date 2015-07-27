<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 26/07/2015
 * Time: 19:29
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FlashController extends Controller {

    /**
     * @Route("/flash/add/{message}", name="addflash")
     */
    public function addFlashAction($message) {

        $this->addFlash(
            'notice',
            $message
        );

        return $this->redirectToRoute('hello', array('name' => 'from flash controller'));
    }
}