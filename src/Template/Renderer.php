<?php declare(strict_types = 1);

namespace YourNamespaceApp\Template;

interface Renderer
{
    public function render($template, $data = []) : string;
}

interface FrontendRenderer extends Renderer {}