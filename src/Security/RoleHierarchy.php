<?php

namespace App\Security;

use App\Entity\SecurityRole;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class RoleHierarchy extends \Symfony\Component\Security\Core\Role\RoleHierarchy
{
    public function __construct(EntityManagerInterface $entityManager, array $hierarchy)
    {
        /** @var NestedTreeRepository $repo */
        $repo = $entityManager->getRepository(SecurityRole::class);
        /** @var SecurityRole $role */
        foreach ($repo->findAll() as $role) {
            if ($role->getChildren()->count() > 0) {
                foreach ($role->getChildren() as $child) {
                    $hierarchy[$role->getRole()][] = $child->getRole();
                }
                $hierarchy[$role->getRole()] = array_unique($hierarchy[$role->getRole()]);
            }
        }

        parent::__construct($hierarchy);
    }
}