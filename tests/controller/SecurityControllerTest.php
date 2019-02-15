<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 15/02/19
 * Time: 23:21
 */

namespace App\Tests\controller;


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


}