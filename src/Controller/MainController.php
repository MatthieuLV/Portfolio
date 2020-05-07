<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use App\Form\MessageType;
use App\Repository\ExperienceRepository;
use App\Repository\TextRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepository, SkillRepository $skillRepository, TextRepository $textRepository, ExperienceRepository $experienceRepository)
    {
        $texts = $textRepository->findAll();
        $projects = $projectRepository->findAll();
        $skills = $skillRepository->findAll();
        $experiences = $experienceRepository->findAll();
        $contactForm = $this->createForm(MessageType::class);
        return $this->render('main/index.html.twig', [
            'texts' => $texts,
            'projects' => $projects,
            'skills' => $skills,
            'experiences' => $experiences,
            'contactForm' => $contactForm->createView(),
        ]);
    }

    /**
     * @Route("/mentions-légales", name="legals")
     */
    public function legals()
    {
        return $this->render('legals.html.twig');
    }
}
