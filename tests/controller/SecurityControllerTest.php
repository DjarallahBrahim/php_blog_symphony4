<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 15/02/19
 * Time: 23:21
 */

namespace App\Tests\controller;


use App\Entity\User;

class SecurityControllerTest extends AbstractSetupClass
{
    /** @test */
    public function loginGetTest()
    {
        $crawler = $this->client->request('GET', '/login');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);
    }

//    public function testLoginPost()
//    {
//        $crawler = $this->client->request('GET', '/login');
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//
//        $user = $this->createFakeUser('user1');
//
//        $form = $crawler->selectButton('Log In')->form();
//
//        $crawler = $this->client
//            ->submit($form,
//                array('_username' => $user->getUsername(),
//                    '_password' => $user->getPassword()));
//
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//
//
//    }
}