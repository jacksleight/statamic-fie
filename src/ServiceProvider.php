<?php

namespace JackSleight\StatamicFie;

use JackSleight\StatamicFie\Actions\EditImage;
use JackSleight\StatamicFie\Fieldtypes\Fie;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../dist/js/addon.js',
    ];

    protected $externalScripts = [
        'https://scaleflex.cloudimg.io/v7/plugins/filerobot-image-editor/latest/filerobot-image-editor.min.js',
    ];

    protected $fieldtypes = [
        Fie::class,
    ];

    protected $actions = [
        EditImage::class,
    ];
}
