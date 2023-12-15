<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Service\LoremIpsumGenerator;

class TrickFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fc = new LoremIpsumGenerator();
        for ($i = 0; $i < 20; $i++) {
            $trick = new Trick();
            $trick->setName('Trick '.$i);
            $trick->setContent($fc->generateLorem());
            $trick->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($trick);
        }
        $manager->flush();
    }
}
