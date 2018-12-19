<?php
namespace App\Controller;


use App\Entity\Dive;
use App\Repository\DiveRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiveController extends AbstractController
{
    /**
     * @var DiveRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * DiveController constructor.
     * @param DiveRepository $repo
     */
    public function __construct(DiveRepository $repo, ObjectManager $em)
    {
        $this->repository = $repo;
        $this->em = $em;
    }

    /**
     * @Route(path="/plongees", name="dive.index")
     * @return Response
     */
    public function index(DiveRepository $repository) : Response
    {
        $dive = new Dive();
        $dive = $this->repository->findAll();


        return $this->render('dive/index.html.twig',[
            'current_menu' => 'dives',
            'dives' => $dive
        ]);
    }

    /**
     * @Route(path="/plongees/{slug}-{id}", name="dive.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Dive $dive, string $slug):Response
    {
        $slugFromObject = $dive->getSlug();

        //Redirection
        if($slugFromObject !== $slug) {
            return $this->redirectToRoute('dive.show', [
                'id' => $dive->getId(),
                'slug' => $slugFromObject
            ], 301);
        }

        return $this->render('dive/show.html.twig', [
            'current_menu' => 'dives',
            'dive' => $dive
        ]);
    }



}