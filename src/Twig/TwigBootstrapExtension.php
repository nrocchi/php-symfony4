<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigBootstrapExtension extends AbstractExtension {

    public function getFilters()
    {
        return [
            new TwigFilter('badge', [$this, 'badgeFilter'], ['is_safe' => ['html']]),
            new TwigFilter('booleanBadge', [$this, 'booleanBadgeFilter'], ['is_safe' => ['html']]),
        ];
    }

    public function badgeFilter($content, array $options = []): string
    {
        $defaultOptions = [
            'color' => 'info',
            'rounded' => false
        ];

        $options = array_merge($defaultOptions, $options);

        $color = $options['color'];
        $pill = $options['rounded'] ? " badge-pill" : "";

        $template = '<span class="badge badge-%s %s">%s</span>';

        return sprintf($template, $color, $pill, $content);
    }

    public function booleanBadgeFilter(bool $content, array $options = []): string
    {
        $defaultOptions = [
            'user' => 'User',
            'admin' => 'Administrator'
        ];

        $options = array_merge($defaultOptions, $options);

        if ($content) {
            return $this->badgeFilter($options['admin'], ['color' => 'danger', 'rounded' => true]);
        }
        else {
            return $this->badgeFilter($options['user'], ['color' => 'info', 'rounded' => true]);
        }
    }
}
