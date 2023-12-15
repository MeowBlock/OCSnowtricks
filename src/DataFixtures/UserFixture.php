<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Service\LoremIpsumGenerator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $fc = new LoremIpsumGenerator();
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName('User '.$i);
            $user->setEmail('myEmail'.$i.'@website.cum');
            $user->setAvatar('default_avatar.png');

            $plaintextPassword = 'FnuyAssword'.$i;

            $hashedPassword = $this->hasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
