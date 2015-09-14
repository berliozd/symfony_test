<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 03/09/2015
 * Time: 23:24
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Author {
    /**
     * @Assert\NotBlank(
        message="{{ value }} ne doit pas être vide !!!!!!!!!"
     * )
     */
    public $name;

}