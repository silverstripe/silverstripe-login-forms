---
title: Providing a custom brand
summary: Customizing the brand logo with different and image formats and support for dark mode
icon: gem
---

# Providing a custom brand

The Login Forms module supports use of a custom brand that will replace the Site Name above the form. The best way to
provide this is in SVG format, as one SVG can be used for all screen densities / display modes, whilst using images will
require variations for each.

Login Forms includes CSS that targets users who have their computers configured to use a dark UI. Thus, you will need to
adjust your logo to work with both light and dark color schemes for browsers that support this feature. This can be
accomplished in different ways depending on what media you use.

## Using an SVG

You can apply Dark Mode support to an SVG logo using one of the following techniques:

- **For monotone logos:** Use `currentColor` as the fill attribute of the SVG. The CSS built into Login Forms will then
  adjust the logo between light and dark automatically.
- **For colourised logos:** Add a `prefers-color-scheme: dark` media query to the SVG's styling, and adjust the colours
  based on that. In some cases, you may be able to use the same colours for both light and dark modes, but you should
  check that they meet Accessibility guidelines in both. See the `SilverStripeLogo.ss` template in [the module repository](https://github.com/silverstripe/silverstripe-login-forms/)
  for an example, and for more information on the `prefers-color-scheme` media query see [this MDN article](https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-color-scheme).

1. Create a template at `app/templates/Includes/AppBrand.ss`.
1. Add the SVG with the class `.app-brand__logo` on it. This class will ensure the Site Title is hidden.
1. Test the login form in a modern browser and OS to ensure the logo looks correct when the system is set to Dark Mode.

## Using an image

Login Forms provides two helper classes for image-based logos: `app-brand__logo--light` and `app-brand__logo--dark`. We
recommend using the srcset API to provide multiple image sizes based on the density of the display, to avoid blurriness.
You can find more information about srcset [on MDN](https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images#Resolution_switching_Same_size_different_resolutions).

1. Create a template at `app/templates/Includes/AppBrand.ss`.
1. Add a dark / black copy of the logo with the classes `app-brand__logo` and `app-brand__logo--light-mode` on it.
1. Add a light / white copy of the logo with the classes `app-brand__logo` and `app-brand__logo--dark-mode` on it.

If you only have one version of the logo, omit the `light-mode` / `dark-mode` classes and it will display in both modes.
