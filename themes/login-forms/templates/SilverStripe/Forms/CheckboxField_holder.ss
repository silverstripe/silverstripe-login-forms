<div id="$HolderID" class="field<% if extraClass %> $extraClass<% end_if %>">
    $Field
    <label class="right" for="$ID">
        $Title
        <% if $RightTitle %> $RightTitle<% end_if %>
    </label>
    <% if $getAttribute('title') %>
        <i class="login-form__help-icon font-icon-help-circled"
           tabindex="0"
           data-toggle="popover"
           data-content="$getAttribute('title')"
           data-trigger="focus"
           data-placement="top"
           data-html="true"
        ></i>
    <% end_if %>
    <% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
    <% if $Description %><span class="description">$Description</span><% end_if %>
</div>
