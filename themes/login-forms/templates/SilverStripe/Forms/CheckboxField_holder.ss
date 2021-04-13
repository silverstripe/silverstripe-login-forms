<div id="$HolderID" class="field<% if extraClass %> $extraClass<% end_if %>">
    $Field
    <label class="right" for="$ID">
        $Title
        <% if $RightTitle %> $RightTitle<% end_if %>
    </label>
    <% if $getAttribute('title') %>
        <i tabindex="0" class="font-icon-help-circled" title="$getAttribute('title')" data-toggle="tooltip"></i>
    <% end_if %>
    <% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
    <% if $Description %><span class="description">$Description</span><% end_if %>
</div>
