<!DOCTYPE html>
<html lang="$Lang">
    <head>
        <% if $SiteConfig.Title %>
            <title>$SiteConfig.Title: <%t SilverStripe\LoginForms.LOGIN "Log in" %></title>
            $Metatags(false).RAW
        <% else %>
            $Metatags.RAW
        <% end_if %>
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="color-scheme" content="light dark" />
        <% require css("silverstripe/login-forms: client/dist/styles/bundle.css") %>
    </head>
    <body>
        <header class="app-brand">
            <% include AppBrand %>

            <h1 class="app-brand__name">
                $SiteConfig.Title
                <% if not $SiteConfig.Title %>SilverStripe<% end_if %>
            </h1>
        </header>

        <main class="login-form">
            <% if $Message %>
                <p class="login-form__message
                    <% if $MessageType && not $AlertType %>login-form__message--$MessageType<% end_if %>
                    <% if $AlertType %>login-form__message--$AlertType<% end_if %>"
                >
                    $Message
                </p>
            <% end_if %>

            <% if $Content && $Content != $Message %>
                <div class="log-in__content">$Content</div>
            <% end_if %>

            $Form
        </main>

        <footer class="silverstripe-brand">
            <% include SilverStripeLogo %>
        </footer>
    </body>
</html>
