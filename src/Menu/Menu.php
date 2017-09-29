<?php declare(strict_types = 1);

namespace YourNamespaceApp\Menu;

interface MenuReader
{
    public function readMenu() : array;
}