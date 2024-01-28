<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Groupe;

class GroupeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arr = ['Les Basiques', 'Figures butter', 'Spins, Flips et Grabs', 'Rail et Box'];
        foreach ($arr as $el) {
            $groupe = new Groupe();
            $groupe->setName($el);
            $manager->persist($groupe);
        }
        $manager->flush();
    }
}