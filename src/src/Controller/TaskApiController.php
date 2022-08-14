<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TaskApiController extends AbstractController
{
    #[Route('/api/tasks', name: 'api_task_list', methods: ['GET'])]
    public function list(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Task::class);
        $tasks = $repository->findAll();
        return $this->json($tasks);
    }

    #[Route('/api/tasks/{id<\d+>}', name: 'api_task_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $repository = $doctrine->getRepository(Task::class);
        $task = $repository->find($id);
        return $this->json($task);
    }
}
