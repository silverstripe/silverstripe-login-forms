# SilverStripe Login Forms

[![Build Status](https://api.travis-ci.org/silverstripe/silverstripe-login-forms.svg?branch=master)](https://travis-ci.org/silverstripe/silverstripe-login-forms)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/silverstripe/silverstripe-login-forms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/silverstripe/silverstripe-login-forms/?branch=master)
[![codecov](https://codecov.io/gh/silverstripe/silverstripe-login-forms/branch/master/graph/badge.svg)](https://codecov.io/gh/silverstripe/silverstripe-login-forms)
[![SilverStripe supported module](https://img.shields.io/badge/silverstripe-supported-0071C4.svg)](https://www.silverstripe.org/software/addons/silverstripe-commercially-supported-module-list/)

## Overview

The [SilverStripe Login Forms module](https://github.com/silverstripe/silverstripe-login-forms) provides templates for the login screen.

SilverStripe defaults to using the standard `Page.ss` template for login forms,
and is usually customised through the `Layout/Security.ss` template.
This module overrides any template or theme inheritance,
and uses it's own `Security.ss` template, in order to provide consistent
styling and behaviour that's independent from the specifics in your project.
This enables more sophisticated login styling, such
as multi-factor authentication through [silverstripe/mfa](https://github.com/silverstripe/silverstripe-mfa).

![Login forms installed in the CMS](docs/en/_images/screenshot.png)

## Requirements

### Installation

Install the package via composer.

```
composer require silverstripe/login-forms
```

The module is enabled by default.

## Usage

### Customising your brand

Even though this template is generic, it's often a good idea
to add your own logo in order to make your login forms
more recogniseable for your users. This can also help
to prevent generic phishing attempts.

Define an `app/templates/Includes/AppBrand.ss` template
and add your own logo. Example:

```html
<div class="app-brand__logo">
    <img src="logo.png" alt="My Brand" />
</div>
```

### Replacing templates

In the unlikely case that you want to re-introduce some customisations
into this new template, you can give priority to your own project templates
(`$default`), or your theme templates.

```yml
---
Before:
  - '#login-forms'
---
SilverStripe\LoginForms\EnablerExtension:
  login_themes:
    - '$default'
    - 'mytheme'
```

Caution: Replacing the `Security.ss` template is not recommended,
since it might change in the future.

### Troubleshooting

This module customises the default log in flow. This in turn uses the `PageController` class by default as the controller to render the form (if it exists). If your project uses the `PageController` class and makes `Requirements::themedJavscript` or `Requirements::themedJavscript` calls from the `init` method, it is possible that an error could occur due to the alteration of the `themes` configuration for the site.

```
[Emergency] Uncaught InvalidArgumentException: The javascript file doesn't exist. Please check if the file sometheme/js/alert.js exists in any context or search for themedJavascript references calling this file in your templates.
```

The override of the themes list by this module is made in order to prevent page styles and javascript from interfering with the presentation of the log in form. There are a number of ways in which to resolve the issue with themed requirements:

1. Add your theme to the new themes list via `SilverStripe\LoginForms\EnablerExtension.login_themes` and test to ensure that there is no adverse affect to the log in flow
2. Shift the required files into the project (as opposed to a theme) and use e.g. `Requirements::javascript` instead of `Requirements::themedJavascript`
3. Copy the `Security.ss` template from the module into your project and add `<% require block() %>` to it (referencing the afflicted file). This will have to be done for each troublesome requriement file.

## Contributing

Contributions are welcome! Create an issue, explaining a bug or propose development ideas. Find more information on
[contributing](https://docs.silverstripe.org/en/contributing/) in the SilverStripe developer documentation.

## Reporting Issues

Please [create an issue](https://github.com/silverstripe/silverstripe-login-forms/issues) for any bugs you've found, or features you're missing.
