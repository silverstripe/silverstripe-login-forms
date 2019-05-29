<?php

namespace SilverStripe\LoginForms\Tests;

use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\LoginForms\EnablerExtension;
use SilverStripe\Security\Security;
use SilverStripe\View\SSViewer;

class EnablerExtensionTest extends FunctionalTest
{
    protected function setUp()
    {
        parent::setUp();
        $config = Config::modify();
        $config->set(SSViewer::class, 'themes', [
            '$public',
            '$default',
        ]);
        $config->set(EnablerExtension::class, 'login_themes', [
            'silverstripe/login-forms:login-forms',
            '$default',
        ]);
        $config->set(EnablerExtension::class, 'excluded_actions', [
            'index',
            'ping',
        ]);
    }

    public function testThatSecurityActionsHaveUpdatedThemeListApplied()
    {
        $this->get(Security::login_url());
        $this->assertContains('silverstripe/login-forms:login-forms', SSViewer::get_themes());
    }

    public function testThatExcludedActionsDoNotHaveTheUpdatedThemeListApplied()
    {
        $this->get('Security/index');
        $this->assertNotContains('silverstripe/login-forms:login-forms', SSViewer::get_themes());
    }
}
