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
        $user = $this->createFakeUser('test');
        $post1 = $this->createFakePost($user);
        $post2 = $this->createFakePost($user);


        $crawler = $this->client->request('GET', '/posts');

        //test that there is two h2 tags that much the post title
        $this->assertSame(2,$crawler->filter('h2')->count());

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

        $this->logIn($user);

        $crawler = $this->client->request('GET', '/post/create');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        //check the title
        $title = $crawler->filter('h2')->text();
        $this->assertSame('Create a new Article', $title);

    }

//    public function testcreatePostwithLoginPost(){
//
//        $user = $this->createFakeUser('test4');
//
//        $this->logIn($user);
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
//        $post = $this->em->getRepository(Post::class)->findByUser($user->getId());
//
//        $this->assertNotNull($post);
//        $this->assertSame($post->getTitle,'Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas Lucas');
//
//        $this->removeFakePost($post);
//        $this->removeFakeUser($user);
//    }

    /** @test */
    public function testDeletePostwithOutLogin()
    {
        $user = $this->createFakeUser('test3');

        $post = $this->createFakePost($user);


        $crawler = $this->client->request('GET', '/post/delete/'.$post->getId());

        $this->assertSame(302, $this->client->getResponse()->getStatusCode());

        //test redirect ot login
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);

    }

    /** @test */
    public function testUpdatePostwithoutLoginGet()
    {
        $user = $this->createFakeUser('test3');

        $post = $this->createFakePost($user);

        $this->client->request('GET', '/post/update/'.$post->getId());

        $this->assertSame(302, $this->client->getResponse()->getStatusCode());

        //test redirect ot login
        $crawler = $this->client->followRedirect();
        $title = $crawler->filter('h4')->text();
        $this->assertSame('Login', $title);

    }

    private function logIn($user)
    {
        $session = $this->client->getContainer()->get('session');
        $firewallName = 'main';
        $firewallContext = 'main';


        $token = new UsernamePasswordToken($user->getUsername(), $user->getPassword(), $firewallName, ['ROLE_USER']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();
        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}