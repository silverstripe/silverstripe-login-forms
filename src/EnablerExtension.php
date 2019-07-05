<?php

namespace SilverStripe\LoginForms;

use SilverStripe\View\SSViewer;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Security;
use SilverStripe\Core\Config\Config;

/**
 * Applies to the {@see Security} controller in order to detect requests for actions related to
 * the log in process or other such credential management (such as the forgot password flow).
 * This is in order to replace the set {@see SSViewer} theme list with a controlled set in order
 * to always show a consistent interface that relates more to the CMS than the website it is
 * loading on.
 * Particular actions can be set to be ignored by including them in the `excluded_actions` list
 * defined in yml _config for this class. By default all allowed actions on the Security controller
 * excepting `index` and `ping` will have the new theme set applied.
 */
class EnablerExtension extends Extension
{
    /**
     * @var array themes to use for log in page and related actions.
     * @config
     */
    private static $login_themes = [];

    /**
     * Aids in preventing themes from being overridden in the case of delegating handlers
     * e.g. if an extension adds a route that should not be styled by login-forms, this config
     * setting can be used to prevent the otherwise blanket override applying to all actions.
     * @var array {@see Security} actions that should not have the custom themes applied
     * @config
     */
    private static $excluded_actions = [
        'index',
        'ping',
    ];

    public function beforeCallActionHandler()
    {
        $config = Config::inst();
        /** @var Security $owner */
        $owner = $this->getOwner();
        $action = $owner->getAction();
        $allowedActions = $config->get(Security::class, 'allowed_actions');
        $excludedActions = $config->get(self::class, 'excluded_actions');
        $themeActions = array_diff($allowedActions, $excludedActions);
        if (in_array($action, $themeActions)) {
            SSViewer::set_themes($config->get(self::class, 'login_themes'));
        }
    }
}
