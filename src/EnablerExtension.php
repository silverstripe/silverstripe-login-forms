<?php

namespace SilverStripe\LoginForms;

use SilverStripe\View\SSViewer;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Config\Config;
use SilverStripe\Security\Security;

class EnablerExtension extends DataExtension
{
    public function beforeCallActionHandler()
    {
        $config = Config::inst();
        $action = $this->owner->getAction();
        $allowedActions = $config->get(Security::class, 'allowed_actions');
        $excludedActions = $config->get(self::class, 'excluded_actions');
        $themeActions = array_diff($allowedActions, $excludedActions);
        if (in_array($action, $themeActions)) {
            SSViewer::set_themes($config->get(self::class, 'login_themes'));
        }
    }
}

