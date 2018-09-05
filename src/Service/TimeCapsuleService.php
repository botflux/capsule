<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 02/09/2018
 * Time: 18:49
 */

namespace App\Service;


use App\Entity\TimeCapsule;
use App\Entity\User;
use App\Repository\TimeCapsuleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class TimeCapsuleService
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var TimeCapsuleRepository
     */
    private $capsuleRepository;

    public function __construct(EntityManagerInterface $entityManager, TimeCapsuleRepository $capsuleRepository)
    {
        $this->manager = $entityManager;
        $this->capsuleRepository = $capsuleRepository;
    }

    /**
     * Returns all capsules that user has contributed or created
     * @param User $user specified user
     * @param string $order
     * @return mixed all capsules
     */
    public function getRelatedToUserCapsules ($user, $order = 'name')
    {
        return $this->capsuleRepository->findRelatedToUser($user, $this->getOrderByName($order));
    }

    public function checkIfCapsuleLinkIsValid ($link)
    {
        $result = $this->capsuleRepository->findByLink ($link);

        if ($result !== null){
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param TimeCapsule $capsule
     * @param User $user
     */
    public function addUserToCapsule(TimeCapsule $capsule, User $user)
    {
        $capsule->addContributor($user);
        $this->manager->flush();
    }

    /**
     * Converts order name into field name
     * @param $orderName
     * @return string
     */
    private function getOrderByName ($orderName)
    {
        switch ($orderName)
        {
            case 'name':
                return 'title';
            case 'date':
                return 'createdAt';
            default:
                return 'title';
        }
    }
}