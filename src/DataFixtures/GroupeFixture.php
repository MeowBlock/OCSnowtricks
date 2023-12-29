<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Groupe;

class GroupeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $groupe = new Groupe();
            $groupe->setName('Group '.$i);
            $manager->persist($groupe);
        }
        $manager->flush();
    }
}