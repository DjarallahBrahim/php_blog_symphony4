<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 09/02/19
 * Time: 18:05
 */

namespace App\Tests\controller;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostControllerTest extends WebTestCase
{

    public function testviewPostsAction()
    {
        $client = static::createClient();

        $client->request('GET', '/posts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}