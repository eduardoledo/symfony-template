<?php

namespace App\Controller\Crud;

use App\Entity\SecurityGroup;
use App\Form\SecurityGroupType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/security/groups")]
class SecurityGroupController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = SecurityGroup::class;
    protected string $type = SecurityGroupType::class;
    protected ?string $title = "Security Groups";
    protected array $indexFields = [
        'id' => 'Id',
        'name' => 'name',
    ];
    protected array $orderByFields = [
        'name' => 'asc'
    ];
}