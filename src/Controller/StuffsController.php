<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\StuffsRepository;
use App\Repository\ContainersRepository;
use App\Entity\Stuffs;
use App\Form\StuffsType;
//use Twig\Environment;

class StuffsController extends AbstractController
{

	public function __construct(StuffsRepository $repository, ContainersRepository $repoContainer, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->repoContainer = $repoContainer;
        $this->em = $em;
    }

    public function add(Request $request, $id){
    	$stuff = new Stuffs;
        
    	$form = $this->createForm(StuffsType::class, $stuff);
    	$form->handleRequest($request);


    	if ($form->isSubmitted() && $form->isValid()){
    		$stuff->setContainerId($id);
                $cont = $this->repoContainer->find($id);
                $stuff->setContainer($cont);
    		$this->em->persist($stuff);
    		$this->em->flush();
    		return $this->redirectToRoute('container', ['id' => $id]);
    	}

    	return $this->render('containers/addStuff.html.twig', [
    		'form' => $form->createView()
    		]
    	);
    }

    public function delete(stuffs $stuff, Request $request){
        //dump($stuffs->getContainerId());die;
        $this->em->remove($stuff);
        $this->em->flush();
        return $this->redirectToRoute('container', [
            'id' => $stuff->getContainerId()
            ]);
    }
    
    public function edit(stuffs $stuff, Request $request){
        
       // $option = new \App\Entity\Option;
        //$stuff->addOption($option);
        
      //  dump($stuff);die;
        
        $form = $this->createForm(StuffsType::class, $stuff);
    	$form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
    		$this->em->flush();
                $this->addFlash('success', 'Contenant modifié');
      		//return $this->redirectToRoute('edit_stuff');
    	}
        
        return $this->render('pages/editStuff.html.twig', [
    		compact('stuff'),
    		'form' => $form->createView()
    		]
    	);
    }
    
    public function empty($id){
        $stuffsQuery = $this->repository->findByContainerIdQuery($id);
        foreach ($stuffsQuery->getResult() as $stuff) {
            $this->em->remove($stuff);
        }
        $this->em->flush();
        return $this->redirectToRoute('container', ['id' => $id]);
    }
}