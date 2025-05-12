<?php

namespace Src;

use Exception;

class View
{
    private string $view = '';
    private array $data = [];
    private string $root = '';
    private string $layout = '/layouts/main.php';

    public function __construct(string $view = '', array $data = [])
    {
        $this->root = $this->getRoot();
        $this->view = $view;
        $this->data = $data;
    }

    private function getRoot(): string
    {
        global $app;
        // Измененный путь - поднимаемся на уровень выше от public
        return dirname($_SERVER['DOCUMENT_ROOT']) . '/views/';
    }

    private function getPathToMain(): string
    {
        return $this->root . $this->layout;
    }

    private function getPathToView(string $view = ''): string
    {
        $view = str_replace('.', '/', $view);
        return $this->root . "/$view.php";
    }

    public function render(string $view = '', array $data = []): string
    {
        $path = $this->getPathToView($view);
        $layoutPath = $this->getPathToMain();

        if (file_exists($layoutPath) && file_exists($path)) {
            extract($data, EXTR_PREFIX_SAME, '');
            ob_start();
            require $path;
            $content = ob_get_clean();
            return require($layoutPath);
        }
        throw new Exception('Error render');
    }

    public function __toString(): string
    {
        return $this->render($this->view, $this->data);
    }
}