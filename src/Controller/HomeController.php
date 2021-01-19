<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Entity\StuffSearch;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
/** var 
 @var Envi
*/
public $twig;

	public function __construct(Environment $twig){
		$this->twig = $twig;
	}

    public function index(Request $request): Response
    {
        $search = new StuffSearch();
        $form = $this->createForm(\App\Form\StuffSearchType::class, $search);
        $form->handleRequest($request);
        $number = random_int(0, 100);

        //return new Response($this->twig->render('pages/home.html.twig'));
        return $this->render('pages/home.html.twig', [
            'form' => $form->createView()
                ]);
        //return new Response('aaa');
    }
}
