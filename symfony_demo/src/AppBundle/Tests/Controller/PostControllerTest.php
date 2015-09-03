<?php
/**
 * Created by PhpStorm.
 * User: Berlioz
 * Date: 30/08/2015
 * Time: 22:56
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostControllerTest extends WebTestCase {

    public function testShowPost() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles');

        $this->assertEquals(
            3,
            $crawler->filter('h2')->count()
        );
    }

}