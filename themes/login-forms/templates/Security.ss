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
        <% require css("silverstripe/login-forms: client/dist/styles/bundle.css") %>
    </head>
    <body>
        <section class="log-in">
            <header>
                <h1 class="log-in__site-name">
                    $SiteConfig.Title
                    <% if not $SiteConfig.Title %>SilverStripe<% end_if %>
                </h1>
            </header>
            <% if $Message %>
                <div class="log-in__message
                    <% if $MessageType && not $AlertType %>log-in__message--$MessageType<% end_if %>
                    <% if $AlertType %>log-in__message--$AlertType<% end_if %>"
                >
                    $Message
                </div>
            <% end_if %>
            <% if $Content && $Content != $Message %><div class="log-in__content">$Content</div><% end_if %>
            $Form
        </section>
        <footer>
            <img
                src="$resourceURL('silverstripe/login-forms:client/dist/img/SilverStripeLogo200.png')"
                alt="<%t SilverStripe\LoginForms.SILVERSTRIPELOGO "SilverStripe Logo" %>"
            />
        </footer>
    </body>
</html>
