<?php

namespace App\Controller;

use App\Entity\TimeCapsule;
use App\Service\TimeCapsuleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @param TimeCapsuleService $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TimeCapsuleService $service)
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'capsules' => $service->getRelatedToUserCapsules($this->getUser())
        ]);
    }

    /**
     * @Route("/")
     */
    public function home ()
    {
        return $this->redirectToRoute('dashboard');
    }
}
