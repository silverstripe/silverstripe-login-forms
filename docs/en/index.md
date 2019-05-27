title: Login Forms
summary: Styling the login forms in the CMS.

# Using login forms in the CMS

The [Login Forms module](https://addons.silverstripe.org/add-ons/silverstripe/login-forms) provides the ability
for SilverStripe users to style the login forms. 

# Providing a custom logo for the login form

The Login Forms module supports application of a custom logo that will replace the Site Name above the form. The best
way to provide this is in SVG format.

## Dark Mode Support

You will need to account for both light and dark color schemes for browsers that
support this feature. To do so, add a `prefers-color-scheme` media query to the SVG's styling, or use `currentColor` as
the fill attribute of the SVG.
