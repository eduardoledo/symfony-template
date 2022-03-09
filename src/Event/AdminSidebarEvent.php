<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class AdminSidebarEvent extends Event
{
    private array $classes = [];

    public function addClass(string $classname, string $title = null, $priority = 0)
    {
        if (!in_array($classname, $this->classes)) {
            $item = [
                'title' => $title ?? $classname,
                'className' => $classname,
                'priority' => $priority
            ];

            $this->classes[] = $item;
        }
    }

    public function getClasses(): array
    {
        return $this->classes;
    }
}