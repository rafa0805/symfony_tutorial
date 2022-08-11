<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
  #[Route('/')]
  public function index(): Response
  {
    return new Response('<h1>Hello!</h1>');
  }

  #[Route('/hello/{name}')]
  public function hello(string $name): Response
  {
    return new Response("<h1>Hello $name !!!</h1>");
  }
}
