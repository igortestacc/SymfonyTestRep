<?php

namespace App\DataFixtures;

use App\Entity\UserNew;
use App\Factory\UserNewFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $userDB = new UserNew();
//        $userDB->setUsername('sombo super mega');
//        $userDB->setAge(20);
//
//        $manager->persist($userDB);
//        $manager->flush();

        UserNewFactory::createMany(20);
    }
}
