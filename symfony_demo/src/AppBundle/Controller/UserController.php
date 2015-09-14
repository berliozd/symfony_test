<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 14/09/2015
 * Time: 22:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {

    /**
     * @Route("/user")
     */
    public function showUser()
    {
        $user = new User();
        $user->setIsPremium(false);
        $user->setCreditCard('ddddddddddddd');

        $validator = $this->get('validator');
        $errors = $validator->validate($user);
        dump($errors);

        return new Response(dump($user));
    }

}