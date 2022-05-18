<?php

namespace SilverStripe\LoginForms;

use SilverStripe\View\SSViewer;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Security;
use SilverStripe\Core\Config\Config;
use SilverStripe\i18n\i18n;

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

    private static bool $enable_dark_mode = true;

    /**
     * Used to store the value of Security.page_class so that we can temporarily disable it
     * so that Security is used as the Controller instead of Page_Controller
     * This is done so that Page_Controller::init() is not called which may included calls
     * to Requirements::javascript(), Requirements::css(), etc
     * The styling and javascript on login-forms module should be completely isolated from the
     * regular website
     *
     * @var string
     *
     * @see Security::getResponseController()
     */
    private $defaultPageClass = '';

    public function beforeCallActionHandler()
    {
        $config = Config::inst();
        /** @var Security $owner */
        $owner = $this->getOwner();
        $action = $owner->getAction();
        $allowedActions = $config->get(Security::class, 'allowed_actions');
        $excludedActions = $config->get(self::class, 'excluded_actions');
        $themeActions = array_diff($allowedActions ?? [], $excludedActions);
        if (in_array($action, $themeActions ?? [])) {
            SSViewer::set_themes($config->get(self::class, 'login_themes'));
        }
        $this->defaultPageClass = $config->get(Security::class, 'page_class');
        Config::modify()->remove(Security::class, 'page_class');
    }

    public function afterCallActionHandler()
    {
        Config::inst()->set(Security::class, 'page_class', $this->defaultPageClass);
    }

    /**
     * Returns an RFC1766 compliant locale string, e.g. 'fr-CA'.
     *
     * Note: Added to support front-end translations trough detection of the lang attribute on
     * the html tag. Because the Security controller extends directly on Controller instead of
     * ContentController we need to add this fallback method.
     *
     * @return string
     */
    public function ContentLocale()
    {
        $locale = i18n::get_locale();
        return i18n::convert_rfc1766($locale);
    }

    public function darkModeIsEnabled()
    {
        return Security::config()->get('enable_dark_mode');
    }
}
