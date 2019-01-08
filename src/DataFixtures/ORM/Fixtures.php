<?php

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author
            ->setName('Djarallah Brahim')
            ->setTitle('Developer')
            ->setUsername('betroc')
            ->setCompany('Uni Lille')
            ->setShortBio('Student at univ of Lille 1, Master 2 E-services 2018-2019')
            ->setPhone('0613158705')
            ->setFacebook('Djarallah Brahim');

        $manager->persist($author);

    }
}