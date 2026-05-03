<!doctype html>
<html lang="$ContentLocale">
<head>
    <% base_tag %>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    $MetaTags(false)

    <% include Favicons %>
    <% require themedCSS('startup') %>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | $SiteConfig.Title</title>
</head>
<body class="$ClassName"<% if $i18nScriptDirection %> dir="$i18nScriptDirection"<% end_if %>>
    <% include Header %>
    $Layout
    <% include Footer %>
    <% if $HasPerm('CMS_ACCESS') %>$SilverStripeNavigator<% end_if %>

    <script>
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 190) { $(".rake-topbar").css("display","flex"); }
        else { $(".rake-topbar").hide(); }
    });
    </script>
</body>
</html>
