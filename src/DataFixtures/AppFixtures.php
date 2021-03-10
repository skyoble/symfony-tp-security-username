<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $superadmin = new User();
        $superadmin->setUsername('superadmin');
        $password = $this->passwordEncoder->encodePassword($superadmin, 'superadmin');
        $superadmin->setPassword($password);
        $superadmin->setRoles(array('ROLE_SUPER_ADMIN'));
        $manager->persist($superadmin);

        $admin = new User();
        $admin->setUsername('admin');
        $password = $this->passwordEncoder->encodePassword($admin, 'admin');
        $admin->setPassword($password);
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);

        $user = new User();
        $user->setUsername('user');
        $password = $this->passwordEncoder->encodePassword($user, 'user');
        $user->setPassword($password);
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $manager->flush();
    }
}
