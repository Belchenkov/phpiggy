<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    public function __construct(private readonly string $base_path)
    {}

    public function render(string $template, array $data = []): string|bool
    {
        extract($data, EXTR_SKIP);

        ob_start();
        include $this->resolve($template);
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public function resolve(string $path): string
    {
        return "{$this->base_path}/{$path}";
    }
}
