<?php

namespace SilverStripe\LoginForms\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\LoginForms\EnablerExtension;
use SilverStripe\Security\Security;
use SilverStripe\View\SSViewer;

class EnablerExtensionTest extends FunctionalTest
{
    protected $usesDatabase = true;

    protected function setUp(): void
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

    public static function provideThatSecurityActionsHaveUpdatedThemeListApplied(): array
    {
        return [
            'regular' => [
                'url' => '/Security/login'
            ],
            'mixed-case' => [
                'url' => '/Security/lOgIn'
            ],
        ];
    }

    #[DataProvider('provideThatSecurityActionsHaveUpdatedThemeListApplied')]
    public function testThatSecurityActionsHaveUpdatedThemeListApplied(string $url)
    {
        $this->get($url);
        $this->assertContains('silverstripe/login-forms:login-forms', SSViewer::get_themes());
    }

    public function testThatExcludedActionsDoNotHaveTheUpdatedThemeListApplied()
    {
        $this->get('Security/index');
        $this->assertNotContains('silverstripe/login-forms:login-forms', SSViewer::get_themes());
    }

    public function testSecurityPageClassConfig()
    {
        // default value
        $this->assertSame('Page', Config::inst()->get(Security::class, 'page_class'));
        // will be set to null during call to Security/index in EnableExtension::beforeCallActionHandler()
        $this->get('Security/index');
        // set back to default value in EnableExtension::afterCallActionHandler()
        $this->assertSame('Page', Config::inst()->get(Security::class, 'page_class'));
    }
}
