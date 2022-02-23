<?php

namespace App\Controller\Crud;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/admin/users")]
class UserController extends BaseCrudController implements EventSubscriberInterface
{
    protected string $entity = User::class;
    protected string $type = RegistrationFormType::class;
    protected array $indexFields = [
        'id' => 'Id',
        'email' => 'email',
    ];
    protected array $orderByFields = [
        'email' => 'asc'
    ];
}
