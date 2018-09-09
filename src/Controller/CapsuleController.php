<?php

namespace App\Controller;

use App\Entity\TimeCapsule;
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
     * @param TimeCapsuleService $service
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function index(TimeCapsuleService $service, Request $request)
    {
        $user = $this->getUser();
        $sorting = $request->get('order');
        $start = $request->get('start');
        $end = $request->get('end');

        if (!(is_numeric($start) && $start > 0)) {
            $start = 1;
        }

        if (!(is_numeric($end) && $end > $start)) {
            $end = 9;
        }

        if ($user !== null) {
            return new JsonResponse(json_encode($service->getRelatedToUserCapsules($user, $sorting, $start, $end)));
        } else {
            return new Response('', 403);
        }
    }

    /**
     * @Route("/capsule/edit/{id}", name="capsule_edit", requirements={"id": "\d+"})
     * @param TimeCapsule $capsule
     * @return Response
     */
    public function editCapsule (TimeCapsule $capsule)
    {
        return $this->render('capsule/index.html.twig', [
            'capsule' => $capsule
        ]);
    }

    /**
     * @Route("/capsule/invite/{link}", name="capsule_invite")
     * @param $link
     * @param TimeCapsuleService $service
     * @return JsonResponse|Response
     */
    public function capsuleInvite ($link, TimeCapsuleService $service)
    {
        if ($this->getUser() === null) {
            return new JsonResponse(json_encode([
                'type' => 'error',
                'message' => 'You are not allowed to access this data'
            ]), 403);
        }

        $capsule = $service->checkIfCapsuleLinkIsValid ($link);

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

        $service->addUserToCapsule ($capsule, $this->getUser());

        return new JsonResponse(json_encode($capsule));
    }
}
