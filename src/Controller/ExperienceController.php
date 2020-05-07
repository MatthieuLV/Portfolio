<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Experience;
use App\Repository\ExperienceRepository;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experience/{id}", name="experience", requirements={"id"="\d+"})
     */
    public function index(Experience $experience, ExperienceRepository $experienceRepository)
    {
        $experience = $experienceRepository->find($experience->getId());
        return $this->render('experience/index.html.twig', [
            'experience' => $experience,
        ]);
    }
}
