<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContainersRepository;
use App\Entity\Containers;
use App\Form\ContainersType;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;  
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AdminContainersController extends AbstractController{
	
	public function __construct(ContainersRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()//: Response
    {

    	$containers = $this->repository->findAll();
        return $this->render('admin/container.html.twig', compact('containers'));
    }

    public function new(Request $request){
    	
    	$container = new Containers();

    	$form = $this->createForm(ContainersType::class, $container);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()){
    		$this->em->persist($container);
    		$this->em->flush();
    		return $this->redirectToRoute('admin_sac');
    	}
    	return $this->render('admin/newContainer.html.twig', [
    		'form' => $form->createView()
    		]
    	);
    }

    public function edit(containers $containers, Request $request, CacheManager $cacheManager, UploaderHelper $helper){
    	
    	$form = $this->createForm(ContainersType::class, $containers);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()){
            
            if ($containers->getImageFile() instanceof UploadedFile){
                $cacheManager->remove($helper->asset($containers, 'imageFile'));
            }

            $this->em->flush();
            $this->addFlash('success', 'Contenant modifié');
            return $this->redirectToRoute('admin_sac');
    	}

    	return $this->render('admin/editContainer.html.twig', [
    		compact('containers'),
    		'form' => $form->createView()
    		]
    	);
    }


    
    public function delete(containers $containers, Request $request){

        if($this->isCsrfTokenValid('delete_sac'.$containers->getId(), $request->get('_token'))){
            $this->em->remove($containers);
            $this->em->flush();
            $this->addFlash('success', 'Sac supprimé');    
        }
    	
    	return $this->redirectToRoute('admin_sac');
    }
}

?>