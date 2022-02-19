<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AdminSidebarEvent extends Event
{
    private $classes = [];

    public function addClass(string $classname)
    {
        if (!in_array($classname, $this->classes)) {
            $this->classes[] = $classname;
        }
    }

    public function getClasses(): array
    {
        return $this->classes;
    }
}