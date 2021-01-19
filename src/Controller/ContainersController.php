<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ContainersRepository;
use App\Repository\StuffsRepository;
use App\Entity\Containers;
use \Knp\Component\Pager\PaginatorInterface;
//use Twig\Environment;

class ContainersController extends AbstractController
{

    public function __construct(ContainersRepository $repository, StuffsRepository $StuffRepository){
        $this->repository = $repository;
        $this->StuffRepository = $StuffRepository;
    }

    public function index(): Response
    {
    	/*
    	$container = new containers();
    	$container->setTitle('test')
    				->setDescription('descd fe');
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($container);
    	$em->flush();
    	*/

    	//$containers = $this->repository->findSelection(); // findAll
        $containers = $this->repository->findAll();
    	//dump($containers);
        return $this->render('containers/containers.html.twig', ['containers' => $containers]);
        //return new Response('aaa');
    }


    public function show($id, PaginatorInterface $paginator, Request $request) : Response
    {
       // $containers = $this->repository->findOneBy(['id' => $id]);
        $container = $this->repository->find($id);
        $stuffsQuery = $this->StuffRepository->findByContainerIdQuery($id);
        $stuffs = $paginator->paginate(
                $stuffsQuery, //QUERY stuffs, not result
                $request->query->getInt('page', 1), /*page number*/
                3
                );
        return $this->render('containers/show.html.twig', ['container' => $container, 'stuffs' => $stuffs]);
    }
}
