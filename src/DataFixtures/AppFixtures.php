<?php

namespace App\DataFixtures;

use App\Entity\SecurityGroup;
use App\Entity\SecurityRole;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $role_admin = (new SecurityRole())
            ->setName('Admin')
            ->setRole('ROLE_ADMIN');
        $manager->persist($role_admin);

        $role_user = (new SecurityRole())
            ->setName('User')
            ->setRole('ROLE_USER');
        //$manager->persist($role_user);

        /** @var NestedTreeRepository $repo */
        $repo = $manager->getRepository(SecurityRole::class);
        $repo->persistAsFirstChildOf($role_user, $role_admin);

        $groupAdmin = (new SecurityGroup())
            ->setName('Admins')
            ->addRole($role_admin);

        $manager->persist($groupAdmin);

        $user = (new User())
            ->setEmail("admin@admin.tld")

            ->setIsVerified(true)
            ->addSecurityRole($role_user)
            ->addSecurityGroup($groupAdmin);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            'admin'
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
