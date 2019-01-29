<?php

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends Fixture
{

    private $encoder;

    /**
     * Fixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {





        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setUsername("admin");
        $user->setPassword(
            $this->encoder->encodePassword($user,"admin")
        );

        $manager->flush();
    }
}