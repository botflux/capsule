<?php

namespace App\Controller;

use App\Entity\TimeCapsule;
use App\Repository\TimeCapsuleRepository;
use App\Service\TimeCapsuleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @param Request $request
     * @param TimeCapsuleService $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, TimeCapsuleService $service)
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
