<header class="app-brand">
    <a
        class="app-brand__link"
        href="/"
        title="Go back to homepage of <% if not $SiteConfig.Title %>$SiteConfig.Title<% else %>site<% end_if %>"
    >
        <% include AppBrand %>

        <h1 class="app-brand__name">
            $SiteConfig.Title
            <% if not $SiteConfig.Title %>SilverStripe<% end_if %>
        </h1>
    </a>
</header>
