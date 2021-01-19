<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
/**
 * Description of SecurityController
 *
 * @author GM
 */
class SecurityController extends AbstractController{
    
    
    public function login(AuthenticationUtils $authenticationUtils) {
    
        $lastUserName = $authenticationUtils->getLastUsername();
        $lastError = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUserName,
            'last_error' => $lastError
        ]);
    }
    
}
