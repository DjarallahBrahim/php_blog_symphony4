<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 16/02/19
 * Time: 13:26
 */

namespace App\Tests\controller;


use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserControllerTest extends AbstractSetupClass
{
    /** @test */
    public function testregisterActionGet()
    {

        $crawler = $this->client->request('GET', '/register');

        //test that there is h2 tags that contain Create a new Account
        $this->assertSame('Create a new Account',$crawler->filter('h2')->text());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

    /** @test */
    public function testupdateUserActionWithoutLoginGet()
    {
        $crawler = $this->client->request('GET', '/user/update');

        //it needs login
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());

        //test redirect ot login
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);
    }

    /** @test */
    public function testupdateUserPasswordActionWithoutLoginGet()
    {
        $crawler = $this->client->request('GET', '/user/update/password');

        //it needs login
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());

        //test redirect ot login
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);
    }

    /** @test */
    public function testUserProfileActionWithoutLoginGet()
    {
        $crawler = $this->client->request('GET', '/user/profile');

        //it needs login
        $this->assertSame(302, $this->client->getResponse()->getStatusCode());

        //test redirect ot login
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);
    }


}