<?php

namespace app\View\MainPage;

use AllowDynamicProperties;
use app\Util\TemplateRenderer;
use app\View\Post\PostView;
use app\View\Util\NavbarView;
use app\View\Util\PostFormView;
use app\View\ViewInterface;

#[AllowDynamicProperties] class MainPageView implements ViewInterface
{
    const MAIN_PAGE_VIEW = 'mainpage/mainpage.html';
    public function __construct(PostView $postView, NavbarView $navbarView, PostFormView $formView)
    {
        $this->formView = $formView;
        $this->navbarView = $navbarView;
        $this->postView = $postView;
    }
    public function renderWithRenderer(TemplateRenderer $renderer): string
    {
        return $renderer->renderHtml(self::MAIN_PAGE_VIEW, [
            'Post' => $this->postView->renderWithRenderer($renderer),
            'PostForm' => $this->formView->renderWithRenderer($renderer),
            'Navbar' => $this->navbarView->renderWithRenderer($renderer)
        ]);
    }
}