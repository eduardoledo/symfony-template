<?php

namespace App\Controller\Crud;

use App\Entity\Categoria;
use App\Event\AdminSidebarEvent;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

abstract class BaseCrudController extends AbstractController
{

    protected string $entity;
    protected string $type;
    protected ?string $title = null;
    protected array $indexFields = [
        'id' => 'Id',
    ];
    protected array $orderByFields = [
        'id' => 'asc'
    ];

    #[ArrayShape([AdminSidebarEvent::class => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            AdminSidebarEvent::class => 'registerInSidebar'
        ];
    }

    #[Route('/', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if ($this->entity) {
            $repository = $entityManager->getRepository($this->entity);
            $items = $repository->findBy([], $this->orderByFields);
            return $this->render('crud/index.html.twig', [
                'items' => $items,
                'newRoute' => $this->getNewRoute(),
                'editRoute' => $this->getEditRoute(),
                'name' => $this->title ?? $this->getEntityName(),
                'fields' => $this->indexFields,
            ]);
        }

        return $this->render('crud/home.html.twig');
    }

    public function getNewRoute(): string
    {
        return $this->getRoutePrefix() . '_new';
    }

    protected function getRoutePrefix(): string
    {
        return strtolower("app_crud_{$this->getEntityName()}");
    }

    protected function getEntityName(): string
    {
        return str_replace('App\\Entity\\', '', $this->entity);
    }

    public function getEditRoute(): string
    {
        return $this->getRoutePrefix() . '_edit';
    }

    #[Route('/new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $item = new $this->entity();
        $form = $this->createForm($this->type, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($item);
            $entityManager->flush();

            return $this->redirectToRoute($this->getIndexRoute(), [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud/new.html.twig', [
            'item' => $item,
            'form' => $form,
            'indexRoute' => $this->getIndexRoute(),
            'name' => $this->title ?? $this->getEntityName(),
        ]);
    }

    public function getIndexRoute(): string
    {
        return $this->getRoutePrefix() . '_index';
    }

    #[Route('/{id}/edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $item = $entityManager->getRepository($this->entity)->find($id);

        if (!$item) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm($this->type, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute($this->getIndexRoute(), [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud/edit.html.twig', [
            'item' => $item,
            'form' => $form,
            'indexRoute' => $this->getIndexRoute(),
            'deleteRoute' => $this->getDeleteRoute(),
            'name' => $this->title ?? $this->getEntityName(),
        ]);
    }

    public function getDeleteRoute(): string
    {
        return $this->getRoutePrefix() . '_delete';
    }

    #[Route("/{id}", methods: ['POST'])]
    public function delete(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $item = $entityManager->getRepository($this->entity)
            ->find($id);
        if ($item && $this->isCsrfTokenValid('delete' . $item->getId(), $request->request->get('_token'))) {
            $entityManager->remove($item);
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->getIndexRoute(), [], Response::HTTP_SEE_OTHER);
    }

    public function registerInSidebar(AdminSidebarEvent $event)
    {
        $event->addClass($this->entity, $this->title ?? $this->getEntityName());
    }
}