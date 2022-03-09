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

        $items = array_map(function ($item) {
            $name = str_replace('App\\Entity\\', '', $item['className']);
            $item['route'] = strtolower("app_crud_{$name}_index");
            if ($item['title'] == $item['className']) {
                $item['title'] = $name;
            }
            return $item;
        }, $event->getClasses());

        usort($items, function ($a, $b) {
            if ($a['priority'] == $b['priority']) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        return $this->render('crud/_entities.html.twig', [
            'items' => $items
        ]);
    }

}
