<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends AbstractController
{
  #[Route('/xss_test_ok', name: 'xss_test_ok_page')]
  public function test_xss_ok(Request $request): Response
  {
    $injectTxt = $request->query->get('text', '');
    return $this->render('sandbox/xss_test_ok.html.twig', [
      'text' => $injectTxt,
    ]);

  }

  #[Route('/xss_test_ng', name: 'xss_test_ng_page')]
  public function test_xss_ng(Request $request): Response
  {
    $injectTxt = $request->query->get('text', '');
    return $this->render('sandbox/xss_test_ng.html.twig', [
      'text' => $injectTxt,
    ]);
  }

  #[Route('/session_test', name: 'session_test_page')]
  public function session_test(SessionInterface $session): Response
  {
    $current_count = !$session->get('count_up') ? 0 : $session->get('count_up');
    $current_count++;
    $session->set('count_up', $current_count);

    return $this->render('sandbox/session_test.html.twig', [
      'sess_id' => $session->getId(),
      'count' => $session->get('count_up'),
    ]);
  }
}
