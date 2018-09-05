<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 02/09/2018
 * Time: 18:49
 */

namespace App\Service;


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

    public function getRelatedToUserCapsules ($user, $order = 'name')
    {
        return $this->capsuleRepository->findRelatedToUser($user, $this->getOrderByName($order));
    }

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