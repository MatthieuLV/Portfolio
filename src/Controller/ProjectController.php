<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project/{id}", name="project", requirements={"id"="\d+"})
     */
    public function index(Project $project, ProjectRepository $projectRepository)
    {
        $project = $projectRepository->find($project->getId());
        return $this->render('project/index.html.twig', [
            'project' => $project,
        ]);
    }
}
