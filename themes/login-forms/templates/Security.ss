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
        <section>
            <header>
                <h1>
                    $SiteConfig.Title
                    <% if not $SiteConfig.Title %>SilverStripe<% end_if %>
                </h1>
            </header>
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
