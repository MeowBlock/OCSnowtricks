<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\Entity\Groupe;
use App\DataFixtures\GroupeFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Service\LoremIpsumGenerator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TrickFixture extends Fixture implements DependentFixtureInterface 
{

    public $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getDependencies() {
        return [
            GroupeFixture::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {

        $gRepo = $manager->getRepository(Groupe::class);
        $allGroups = $gRepo->findAll();
        $fc = new LoremIpsumGenerator();
        for ($i = 0; $i < 20; $i++) {

            $numba = random_int(0, count($allGroups) - 1);

            $trick = new Trick();
            $trick->setName('Trick '.$i);
            $trick->setContent($fc->generateLorem());
            $trick->setCreatedAt(new \DateTimeImmutable());
            $trick->setGroupe($allGroups[$numba]);
            $manager->persist($trick);
        }
        $manager->flush();
    }
}
