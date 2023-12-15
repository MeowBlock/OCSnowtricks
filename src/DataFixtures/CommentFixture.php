<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Service\LoremIpsumGenerator;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixture extends Fixture implements DependentFixtureInterface 
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    public function getDependencies() {
        return [
            UserFixture::class,
            TrickFixture::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {

        $fc = new LoremIpsumGenerator();
        $uRepo = $manager->getRepository(User::class);
        $tRepo = $manager->getRepository(Trick::class);
        $allTricks = $tRepo->findAll();
        $allUsers = $uRepo->findAll();
        foreach($allTricks as $trick) {
            if(random_int(0, 10) < 8) {
                continue;
            }
            $numba = random_int(0, count($allUsers) - 1);
            $comment = new Comment();
            $comment->setAuthor($allUsers[$numba]);
            $comment->setTrick($trick);
            $comment->setContent($fc->generateLorem(random_int(1, 20)));
            $manager->persist($comment);
        }
        $manager->flush();
    }


}
