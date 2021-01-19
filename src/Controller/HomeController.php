<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController
{
/** var 
 @var Envi
*/
public $twig;

	public function __construct(Environment $twig){
		$this->twig = $twig;
	}

    public function index(): Response
    {
        $number = random_int(0, 100);

        return new Response($this->twig->render('pages/home.html.twig'));
        //return new Response('aaa');
    }
}
