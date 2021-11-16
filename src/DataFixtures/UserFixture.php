<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends AbstractFixture
{

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $user = new User();

            $user
                ->setEmail($data['email'])
                ->setPassword($this->userPasswordHasher->hashPassword($user, $data['password']))
                ->setIsVerified($data['isVerified']);

            if (isset($data['roles'])) {
                $user->setRoles($data['roles']);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }

    protected function getYamlPath(): string
    {
        return 'users.yaml';
    }
}
