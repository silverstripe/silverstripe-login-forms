<header class="app-brand">
    <a
        class="app-brand__link"
        href="$AbsoluteBaseURL"
        title="<%t SilverStripe\LoginForms.BackToHomePage "Go back to homepage" %>"
    >
        <% include AppBrand %>

        <h1 class="app-brand__name">
            $SiteConfig.Title
            <% if not $SiteConfig.Title %>SilverStripe<% end_if %>
        </h1>
    </a>
</header>
