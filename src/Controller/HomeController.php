<?php
namespace App\Controller;


use App\Repository\DiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route(path="/", name="home")
     * @param DiveRepository $repository
     * @return Response
     */
    public function index(DiveRepository $repository) : Response
    {
        $dives = $repository->findLatest();
        return $this->render('pages/home.html.twig',[
            'dives' => $dives
        ]);

    }




}