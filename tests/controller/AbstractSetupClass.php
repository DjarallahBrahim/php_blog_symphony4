<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 15/02/19
 * Time: 17:31
 */

namespace App\Tests\controller;


use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;


class AbstractSetupClass extends WebTestCase
{
    protected static $application;

    protected $client = null;
    protected $em = null;

    protected function setUp()
    {
        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');

        $this->client = static::createClient();
        $this->em = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function createFakePost($fakeUser)
    {
        $post = new Post();

        $post->setBody('Fake body Fake body Fake body Fake body Fake body Fake body Fake body Fake body');
        $post->setCreatedAt(new \DateTime('2019-02-23'));
        $post->setUpdatedAt(new \DateTime('2019-02-23'));
        $post->setUser($fakeUser);
        $post->setTitle('Fake Title Fake Title Fake Title Fake Title Fake Title');
        $post->setDescription('this is a description this is a description this is a description this is a description');
        $this->em->persist($post);
        $this->em->flush();

        return $post;
    }

    public function createFakeUser($fakeUsername)
    {
        $user = new User();

        $user->setShortBio('this is a short Bio this is a short Bio this is a short Bio this is a short Biothis is a short Bio');
        $user->setPhone('0000000000');
        $user->setEmail($fakeUsername.'user@user.com');
        $user->setUsername($fakeUsername);
        $user->setPassword($fakeUsername.'password');

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function removeFakeUser($user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function removeFakePost($post)
    {
        $this->em->remove($post);
        $this->em->flush();
    }

    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected function tearDown()
    {
        self::runCommand('doctrine:database:drop --force');

        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}