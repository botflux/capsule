<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 01/09/2018
 * Time: 18:17
 */

namespace App\Service;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, UserRepository $repository)
    {
        $this->entityManager = $manager;
        $this->passwordEncoder = $encoder;
        $this->userRepository = $repository;
    }

    /**
     * Check if a user is already user this email address.
     * @param $email
     * @return bool
     */
    public function checkIfUserExists ($email)
    {
        return $this->userRepository->findByEmail ($email) !== null;
    }

    /**
     * Encode the user password. Pass a user with a plaintext password.
     * @param $user
     * @return User
     */
    public function encodePassword ($user)
    {
        $encoded = $this->passwordEncoder->encodePassword($user, $user->getPassword());
        return ($user->setPassword($encoded));
    }

    /**
     * Generates a random api key
     * @return string
     * @throws \Exception
     */
    public function getRandomApiKey()
    {
        $random = random_bytes(20);
        $randomHash = hash('md5', $random);
        return $randomHash;
    }


}