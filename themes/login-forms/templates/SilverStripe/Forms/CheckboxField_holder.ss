<div id="$HolderID" class="field<% if extraClass %> $extraClass<% end_if %>">
    $Field
    <label class="right" for="$ID">
        $Title
        <% if $RightTitle %> $RightTitle<% end_if %>
    </label>
    <% if $getAttribute('title') && $getAttribute('data-toggle') == 'tooltip' %>
    <i class="font-icon-help-circled" title="$getAttribute('title')" data-toggle="$getAttribute('data-toggle')"
    ></i>
    <% end_if %>
    <% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
    <% if $Description %><span class="description">$Description</span><% end_if %>
</div>