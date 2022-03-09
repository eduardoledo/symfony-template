<?php

namespace App\Controller\Crud;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/admin/users")]
class UserController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = User::class;
    protected string $type = UserType::class;
    protected ?string $title = "Users";
    protected array $indexFields = [
        'id' => 'Id',
        'email' => 'email',
    ];
    protected array $orderByFields = [
        'email' => 'asc'
    ];
}
