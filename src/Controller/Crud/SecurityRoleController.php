<?php

namespace App\Controller\Crud;

use App\Entity\SecurityRole;
use App\Form\SecurityRoleType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/security/roles")]
class SecurityRoleController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = SecurityRole::class;
    protected string $type = SecurityRoleType::class;
    protected ?string $title = "Security Roles";
    protected array $indexFields = [
        'id' => 'Id',
        'name' => 'Name'
    ];

}