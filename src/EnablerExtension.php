<?php

namespace SilverStripe\LoginForms;

use SilverStripe\View\SSViewer;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Config\Config;

class EnablerExtension extends DataExtension
{
    public function onBeforeInit()
    {
        SSViewer::set_themes(Config::inst()->get(self::class, 'login_themes'));
    }
}
