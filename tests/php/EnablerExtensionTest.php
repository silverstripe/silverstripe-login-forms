<?php

namespace SilverStripe\LoginForms\Tests;

use Config;
use FunctionalTest;
use SilverStripe\LoginForms\EnablerExtension;
use Security;
use SSViewer;

class EnablerExtensionTest extends FunctionalTest
{
    protected $usesDatabase = true;

    public function setUp()
    {
        parent::setUp();

        $config = Config::inst();
        $config->update(SSViewer::class, 'theme', null);
        $config->update(EnablerExtension::class, 'excluded_actions', [
            'index',
            'ping',
        ]);
    }

    public function testThatSecurityActionsHaveUpdatedThemeListApplied()
    {
        $response = $this->get(Security::login_url());
        $this->assertContains('app-brand__link', $response->getBody());
    }

    public function testThatExcludedActionsDoNotHaveTheUpdatedThemeListApplied()
    {
        $response = $this->get('Security/index');
        $this->assertNotContains('app-brand__link', $response->getBody());
    }
}
