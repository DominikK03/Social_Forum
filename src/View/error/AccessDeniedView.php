<?php

namespace app\View\error;

use AllowDynamicProperties;
use app\Util\TemplateRenderer;
use app\View\ViewInterface;

#[AllowDynamicProperties] class AccessDeniedView implements ViewInterface
{
    public function __construct(TemplateRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function renderWithRenderer(TemplateRenderer $renderer): string
    {
        return $renderer->renderHtml('error/401.html');
    }
}