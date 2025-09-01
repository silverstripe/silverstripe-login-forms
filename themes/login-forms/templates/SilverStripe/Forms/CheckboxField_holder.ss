<div id="$HolderID" class="field<% if extraClass %> $extraClass<% end_if %>">
    $Field
    <label class="form-label right" for="$ID">
        $Title
        <% if $RightTitle %> $RightTitle<% end_if %>
    </label>
    <% if $getAttribute('title') %>
        <span class="login-form__help-icon"
           tabindex="0"
           data-bs-toggle="popover"
           data-bs-content="$getAttribute('title')"
           data-bs-trigger="focus"
           data-bs-placement="top"
           data-bs-html="true"
        >
            <span class="font-icon-help-circled" aria-hidden="true"></span>
        </span>
    <% end_if %>
    <% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
    <% if $Description %><span class="description">$Description</span><% end_if %>
</div>
