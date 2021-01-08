<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Post\Markdown\MentionNotificationScenario;
use App\Contracts\Post\Markdown\MentionNotificationScenario as MarkdownMentionContract;
use App\Registries\NotificationRedirectorRegistry;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MarkdownMentionContract::class,
            MentionNotificationScenario::class
        );

        $this->app->singleton(NotificationRedirectorRegistry::class);

        $this->registerNotificationRedirector();
    }

    protected function registerNotificationRedirector() {
        $redirectors = config('notification-redirector');

        if( ! is_array($redirectors) ) return;

        foreach( $redirectors as $key => $redirector ) {
            $this->app->make(NotificationRedirectorRegistry::class)->register(
                $key, app($redirector)
            );
        }
    }
}
