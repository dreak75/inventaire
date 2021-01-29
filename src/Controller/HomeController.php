<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Entity\StuffSearch;
use App\Repository\StuffsRepository;
use Symfony\Component\HttpFoundation\Request;
use \Knp\Component\Pager\PaginatorInterface;


class HomeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
/** var 
 @var Envi
*/
public $twig;

	public function __construct(Environment $twig, StuffsRepository $StuffRepository){
            $this->StuffRepository = $StuffRepository;
            $this->twig = $twig;
	}

    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $search = new StuffSearch();
        $form = $this->createForm(\App\Form\StuffSearchType::class, $search);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()){
            $stuffsQuery = $this->StuffRepository->findBySearchQuery($search);
            $stuffs = $paginator->paginate(
                    $stuffsQuery, //QUERY stuffs, not result
                    $request->query->getInt('page', 1), /*page number*/
                    4
                    );
            
            return $this->render('pages/home.html.twig', [
            'form' => $form->createView(),
            'stuffs' => $stuffs
                ]);
        }else{
            return $this->render('pages/home.html.twig', [
            'form' => $form->createView(),
                ]);
        }
        //return new Response($this->twig->render('pages/home.html.twig'));
        //return new Response('aaa');
    }
}
