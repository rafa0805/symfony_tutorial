<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
  public function index(): Response
  {
    return new Response('<h1>Hello!</h1>');
  }

  public function hello(string $name): Response
  {
    return new Response("<h1>Hello $name !!!</h1>");
  }
}
