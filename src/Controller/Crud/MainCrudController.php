<?php

namespace App\Controller\Crud;

use App\Event\AdminSidebarEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainCrudController extends AbstractController
{
    #[Route("/admin")]
    public function index(): Response
    {
        return $this->render('crud/home.html.twig');
    }

    public function entities(EventDispatcherInterface $eventDispatcher): Response
    {
        /** @var AdminSidebarEvent $event */
        $event = $eventDispatcher->dispatch(new AdminSidebarEvent());

        $items = [];

        foreach ($event->getClasses() as $class) {
            $name = str_replace('App\\Entity\\', '', $class);
            $items[] = [
                'title' => $name,
                'route' => strtolower("app_crud_{$name}_index"),
            ];
        }

        return $this->render('crud/_entities.html.twig', [
            'items' => $items
        ]);
    }

}
