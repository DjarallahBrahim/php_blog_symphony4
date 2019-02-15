<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 09/02/19
 * Time: 18:05
 */

namespace App\Tests\controller;



use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class PostControllerTest extends AbstractSetupClass
{
    /** @test */
    public function testviewPostsAction()
    {

        $this->client->request('GET', '/posts');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

    /** @test */
    public function testviewPostAction()
    {

        $user = $this->createFakeUser('test');

        $post = $this->createFakePost($user);



        $crawler = $this->client->request('GET', '/post/view/'.$post->getId());


        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        //check the h1 tag if containe the post title
        $title = $crawler->filter('h1')->text();
        $this->assertSame($post->getTitle(),trim($title));


        $this->removeFakePost($post);
        $this->removeFakeUser($user);
    }

    /** @test */
    public function testcreatePostwithoutLoginGet()
    {
        $this->client->request('GET', '/post/create');

        $this->assertSame(302, $this->client->getResponse()->getStatusCode());
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);

    }


    /** @test */
    public function testcreatePostwithLoginGet()
    {
        $user = $this->createFakeUser('test3');

        $this->logIn('test3');

        $crawler = $this->client->request('GET', '/post/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        //check the title
        $title = $crawler->filter('h2')->text();
        $this->assertSame('Create a new Article', $title);

        $this->removeFakeUser($user);

    }

//    public function testcreatePostwithLoginPost(){
//
//        $user = $this->createFakeUser('test4');
//
//        $this->logIn('test4');
//
//        $crawler = $this->client->request('GET', '/post/create');
//
//        $buttonCrawlerNode = $crawler->selectButton('Submit');
//
//
//        $form = $buttonCrawlerNode->form([
//            'post[title]'    => 'Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas',
//            'post[description]' => 'Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! Hey there! ',
//            'post[body]' => 'Symfony rocks!',
//        ]);
//
//        $crawler = $this->client->submit($form);
//
//        $post = $this->em->getRepository(Post::class)->findOneByUser('test4');
//
//        $this->assertNotNull($post);
//        $this->assertSame($post->getTitle,'Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas');
//
//        $this->removeFakePost($post);
//        $this->removeFakeUser($user);
//    }

    private function logIn($username)
    {
        $session = $this->client->getContainer()->get('session');
        $firewallName = 'main';
        $firewallContext = 'main';

        $user = $this->em->getRepository(User::class)->findOneByUsername($username);

        $token = new UsernamePasswordToken($username, $user->getPassword(), $firewallName, ['ROLE_USER']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();
        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }



}