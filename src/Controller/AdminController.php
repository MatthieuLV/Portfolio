<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Skill;
use App\Form\ExperienceType;
use App\Form\ProjectType;
use App\Form\SkillType;
use App\Repository\ExperienceRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Photo;
use Doctrine\Common\Collections\ArrayCollection;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/skill/new", name="new_skill")
     * @Route("/admin/skill/{id}", name="modif_skill", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function addSkill(Skill $skill=null ,Request $request,EntityManagerInterface $manager)
    {
        if(!$skill){
            $skill = new Skill();
        }

        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($skill);
            $manager->flush();
            $this->addFlash('success', "La compétence a bien été ajoutée");
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/skill/modification.html.twig', [
            'skill' => $skill,
            'skillForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/project/new", name="new_project")
     * @Route("/admin/project/{id}", name="modif_project", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function addProject(Project $project=null ,Request $request,EntityManagerInterface $manager)
    {
        if(!$project){
            $project = new Project();
        }

        $originalPhotos = new ArrayCollection();
        $originalDocuments = new ArrayCollection();

        foreach ($project->getPhotos() as $photo) {
            $originalPhotos->add($photo);
        }

        foreach ($project->getDocuments() as $document) {
            $originalDocuments->add($document);
        }

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {   
            $manager = $this->getDoctrine()->getManager();
           
            $datas = $form->getData();
            
            foreach ($datas->getPhotos() as $photo){
                $manager->persist($photo);
            }

            foreach ($datas->getDocuments() as $document){
                $manager->persist($document);
            }


            $manager->persist($project);
            $manager->flush();
            $this->addFlash('success', "Le projet a bien été ajouté");
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/project/modification.html.twig', [
            'project' => $project,
            'projectForm' => $form->createView()
        ]);
    }

    


    /**
     * @Route("/admin/experience/new", name="new_experience")
     * @Route("/admin/experience/{id}", name="modif_experience", methods="GET|POST")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function addExperience(Experience $experience=null ,Request $request,EntityManagerInterface $manager)
    {
        if(!$experience){
            $experience = new Experience();
        }
        
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($experience);
            $manager->flush();
            $this->addFlash('success', "L'expérience a bien été ajoutée");
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/experience/modification.html.twig', [
            'experience' => $experience,
            'experienceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/projects", name="projects")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function viewProjects(ProjectRepository $projectRepository)
    {
        $projects = $projectRepository->findAll();
        return $this->render('admin/project/projects.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/admin/skills", name="skills")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function viewSkills(SkillRepository $skillRepository)
    {
        $skills = $skillRepository->findAll();
        return $this->render('admin/skill/skills.html.twig', [
            'skills' => $skills,
        ]);
    }

    /**
     * @Route("/admin/experiences", name="experiences")
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits nécéssaires.")
     */
    public function viewExperiences(ExperienceRepository $experienceRepository)
    {
        $experiences = $experienceRepository->findAll();
        return $this->render('admin/experience/experiencess.html.twig', [
            'experiences' => $experiences,
        ]);
    }
}
