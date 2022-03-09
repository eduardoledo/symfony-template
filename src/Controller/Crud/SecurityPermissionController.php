<?php

namespace App\Controller\Crud;


use App\Entity\SecurityPermission;
use App\Form\SecurityPermissionType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/security/permissions")]
class SecurityPermissionController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = SecurityPermission::class;
    protected string $type = SecurityPermissionType::class;
    protected ?string $title = "Security Permissions";
    protected array $indexFields = [
        'id' => 'Id',
        'name' => 'name',
    ];
    protected array $orderByFields = [
        'name' => 'asc'
    ];

}