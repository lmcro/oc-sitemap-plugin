<?php

/** @noinspection PhpMissingParentCallCommonInspection */

declare(strict_types=1);

namespace Vdlp\Sitemap;

use Illuminate\Contracts\Events\Dispatcher;
use System\Classes\PluginBase;
use Vdlp\Sitemap\Classes\EventSubscribers;
use Vdlp\Sitemap\ServiceProviders;

/**
 * Class Plugin
 *
 * @package Vdlp\Sitemap
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritdoc}
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'Sitemap',
            'description' => 'A sitemap.xml generator for October CMS.',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-leaf',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->register(ServiceProviders\SitemapServiceProvider::class);

        /** @var Dispatcher $events */
        $events = $this->app->make(Dispatcher::class);
        $events->subscribe($this->app->make(EventSubscribers\SitemapSubscriber::class));
    }
}
