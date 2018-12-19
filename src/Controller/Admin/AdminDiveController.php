<?php
namespace App\Controller\Admin;

use App\Entity\Dive;
use App\Form\DiveType;
use App\Repository\DiveRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminDiveController extends AbstractController
{
    /**
     * @var DiveRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(DiveRepository $repo, ObjectManager $em)
    {
        $this->repository = $repo;
        $this->em = $em;
    }

    /**
     * @Route(path = "/admin", name = "admin.dive.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $dives = $this->repository->findAll();
        return $this->render('admin/dive/index.html.twig',[
            'dives' => $dives
        ]);
    }

    /**
     * @Route (path="/admin/dive/{id}", name="admin.dive.edit", methods="GET|POST")
     * @param Dive $dive
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Dive $dive, Request $request)
    {
       $form = $this->createForm(DiveType::class, $dive);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
           $this->em->flush();
           return $this->redirectToRoute('admin.dive.index');

       }

       return $this->render('admin/dive/edit.html.twig',[
           'dive' => $dive,
           'form' => $form->createView()
       ]);
    }


    /**
     * @Route(path="/admin/dive/create", name="admin.dive.new")
     */
    public function new(Request $request)
    {
        $dive = new Dive();

        $form = $this->createForm(DiveType::class, $dive);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($dive);
            $this->em->flush();
            return $this->redirectToRoute('admin.dive.index');

        }
        return $this->render('admin/dive/new.html.twig',[
            'dive' => $dive,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route(path="/admin/dive/{id}", name="admin.dive.delete", methods="DELETE")
     * @param Dive $dive
     *
     * @return Response
     */
    public function delete(Dive $dive, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $dive->getId(), $request->get('_token'))){
            $this->em->remove($dive);
            $this->em->flush();
        }
        return $this->redirectToRoute('admin.dive.index');
    }


}