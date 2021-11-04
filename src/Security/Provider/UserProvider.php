<?php

namespace App\Security\Provider;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function loadUserByUsername(string $username)
    {
        trigger_deprecation('symfony/doctrine-bridge', '5.3', 'Method "%s()" is deprecated, use loadUserByIdentifier() instead.', __METHOD__);

        return $this->loadUserByIdentifier($username);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findOneBy([
            'email' => $identifier,
            'isVerified' => true
        ]);

        if (null === $user) {
            $e = new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
            $e->setUserIdentifier($identifier);

            throw $e;
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_debug_type($user)));
        }

        $refreshedUser = $this->userRepository->find($user->getId());

        if (null === $refreshedUser) {
            $e = new UserNotFoundException('User with id ' . $user->getId() . ' not found.');
            $e->setUserIdentifier($user->getId());

            throw $e;
        }

        return $refreshedUser;
    }

    public function supportsClass(string $class)
    {
        return $class === User::class;
    }
}
