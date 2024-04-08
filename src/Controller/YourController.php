<?php
// src/Controller/YourController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YourController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return $this->render('home.html.twig');
    }
    
    #[Route('/b', name: 'b')]
    public function b(): Response
    {
        return $this->render('home.html.twig');
    }
    #[Route('/home2', name: 'home2')]
    public function home2(): Response
    {
        return $this->render('home2.html.twig');
    }
}
