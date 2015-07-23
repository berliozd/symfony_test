<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 23/07/2015
 * Time: 23:42
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController {
    /**
     * @Route("/lucky/number")
     */
    public function numberAction() {
        $number = rand(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }
}