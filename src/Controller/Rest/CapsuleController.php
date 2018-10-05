<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 15/09/2018
 * Time: 18:17
 */

namespace App\Controller\Rest;

use App\Entity\TimeCapsule;
use App\Repository\TimeCapsuleRepository;
use App\Service\TimeCapsuleService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CapsuleController extends FOSRestController
{
    /**
     * @Rest\Post("/capsules")
     * @param Request $request
     * @param TimeCapsuleService $service
     * @return View
     * @throws \Exception
     */
    public function postCapsules (Request $request, TimeCapsuleService $service, ValidatorInterface $validator): View
    {
        $title = $request->get('title');
        $description = $request->get('description');
        $closingAt = $request->get('closingAt');

        if ($title === null || $description === null || $closingAt === null) {
            throw new \InvalidArgumentException();
        }

        $capsule = (new TimeCapsule())
            ->setTitle($title)
            ->setDescription($description)
            ->setClosingAt(new \DateTimeImmutable($closingAt))
            ->setOwner($this->getUser())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setInviteLink($service->getRandomInviteLink());

        $errors = $validator->validate($capsule);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new \InvalidArgumentException('There is errors is this entity: ' . $errorsString);
        }

        $service->addCapsule($capsule);

        return View::create($capsule, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/capsules/{capsuleId}")
     * @param Request $request
     * @param TimeCapsuleService $service
     * @param TimeCapsuleRepository $repository
     * @param int $capsuleId
     * @return View
     * @throws \Exception
     */
    public function putCapsules (Request $request, TimeCapsuleService $service, TimeCapsuleRepository $repository, int $capsuleId): View
    {
        $capsule = $repository->find($capsuleId);

        $capsule
            ->setTitle($request->get('title'))
            ->setDescription($request->get('description'))
            ->setClosingAt(new \DateTimeImmutable($request->get('closingAt')));

        $em = $this->getDoctrine()->getManager();
        $em->persist($capsule);
        $em->flush();

        return View::create($capsule, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/capsules/{capsuleId}")
     * @param int $capsuleId
     * @param TimeCapsuleRepository $repository
     * @return View
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteCapsules (int $capsuleId, TimeCapsuleRepository $repository): View
    {
        $capsule = $repository->find($capsuleId);

        if ($capsule) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($capsule);
            $em->flush();
        }

        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Get("/capsules/{capsuleId}")
     * @param int $capsuleId
     * @param TimeCapsuleRepository $repository
     * @return View
     * @throws EntityNotFoundException
     */
    public function getCapsule (int $capsuleId, TimeCapsuleRepository $repository): View
    {
        $capsule = $repository->find($capsuleId);
        if (!$capsule) {
            throw new EntityNotFoundException(sprintf('Time capsule %s does not exists', $capsuleId));
        }
        return View::create($capsule, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/capsules")
     * @param Request $request
     * @param TimeCapsuleService $service
     * @return View
     */
    public function getCapsules (Request $request, TimeCapsuleService $service): View
    {
        $capsules = $service->getRelatedToUserCapsules($this->getUser(), $request->get('order'), $request->get('start'), $request->get('end'));/*$repository->findRelatedToUser($request->getUser(), $request->get('start'), $request->get('end'), $request->get('order'));*/

        return View::create($capsules, Response::HTTP_OK);
    }
}