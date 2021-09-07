<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('jrauzad@gmail.com');
        $user->setPassword('$2y$13$txl9qO7N/O10VaEHteiWm.HO.s0vT1fD00qW3JomldXVbLfcPxJb.');
        $manager->persist($user);

        $manager->flush();
    }
}
