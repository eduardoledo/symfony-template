<?php

namespace App\Controller\Crud;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/admin/users")]
class UserController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = User::class;
//    protected string $type = CategoriaType::class;
    protected array $indexFields = [
        'id' => 'Id',
        'name' => 'Nombre',
    ];
    protected array $orderByFields = [
        'name' => 'asc'
    ];
}
