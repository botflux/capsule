<?php

namespace App\Controller;

use App\Service\TimeCapsuleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CapsuleController extends AbstractController
{
    /**
     * @Route("/capsule", name="capsule")
     */
    public function index()
    {
        return $this->render('capsule/index.html.twig', [
            'controller_name' => 'CapsuleController',
        ]);
    }

    /**
     * @Route("/capsule/invite/{link}", name="capsule_invite")
     * @param $link
     * @param TimeCapsuleService $service
     * @return JsonResponse
     */
    public function capsuleInvite ($link, TimeCapsuleService $service)
    {
        if ($capsule = $service->checkIfCapsuleLinkIsValid ($link)) {
            $service->addUserToCapsule ($capsule, $this->getUser());
        }

        if ($capsule === false) {
            return new Response('No capsule matchs the given link', 404);
        }

        if ($capsule->getOwner() === $this->getUser()) {
            return new JsonResponse([
                'type' => 'warning',
                'message' => 'You can\'t be invite if you are the owner',
            ]);
        }

        if ($capsule->getContributors()->contains($this->getUser())) {
            return new JsonResponse([
                'type' => 'warning',
                'message' => 'You are already a contributors of this time capsule',
            ]);
        }

        return new JsonResponse(json_encode($capsule));
    }
}
