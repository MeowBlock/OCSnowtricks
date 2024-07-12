<?php

namespace App\DataFixtures;

use App\Entity\Photo;
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
        $groupList = ['Les Basiques' => ['Ollie','Jibbing', 'Switch Riding', 'Shifty'], 'Figures butter' => ['Tail Roll','Butter', 'Nose Roll', 'Tripod'], 'Spins, Flips et Grabs' => ['Indy Grab','Alley-oop', 'Backside 360', 'Backflip'], 'Rail et Box' => ['Boardslide','Nose Bonk', 'Tail Press', 'Lipslide']];
        $photoList = ['Les Basiques' => 'trickDefaultBasics.jpg', 'Figures butter' => 'trickDefaultButter.jpg', 'Spins, Flips et Grabs' => 'trickDefaultFlips.jpg', 'Rail et Box' => 'trickDefaultRail.jpg'];

        $groupCount = count($groupList);
        $tricksPerGroup = count($groupList[array_keys($groupList)[0]]);
        for($i = 0; $i < $tricksPerGroup; $i++) {
            //loop on each trick



            for($j = 0; $j < $groupCount; $j++) {
                //loop one trick per group at a time

                $trickName = $groupList[array_keys($groupList)[$j]][$i];
                $groupe = array_keys($groupList)[$j];




                $trick = new Trick();
                $photo = new Photo();

                $photo->setUrl('../../'.$photoList[$groupe]);
                $photo->setTrick($trick);
                $trick->addPhoto($photo);
    
                $trick->setGroupe($gRepo->findOneBy(['name' => $groupe]));
                $trick->setName($trickName);
                $trick->setContent($fc->generateLorem());

                $manager->persist($photo);
                $manager->persist($trick);
            }
        }
        $manager->flush();
    }
}
