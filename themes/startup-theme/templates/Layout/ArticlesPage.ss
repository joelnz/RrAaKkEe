<%-- SECTION 1: Feature row — label + featured + secondary --%>
<% if $SectionFeatured %>
<div class="featured-row">

    <div class="featured-row__label">
        <div class="featured-row__label-inner">
            <h1>$Title</h1>
            <h3><span>$Now.Format("EEEE")</span><br>$Now.Format("d MMMM Y")</h3>
        </div>
    </div>

    <div class="featured-row__main">
        <% with $SectionFeatured %>
        <div class="featured-row__text">
            <div class="featured-row__text-inner">
                <a href="$Link"><h1>$Title</h1></a>
                <% if $Excerpt %><h2>$Excerpt</h2><% end_if %>
            </div>
        </div>
        <div class="featured-row__image">
            <div class="featured-row__image-wrap">
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(880,632)
                    <% else %>
                        <div class="news-placeholder" style="width:100%;padding-top:66.66%;"></div>
                    <% end_if %>
                </a>
            </div>
        </div>
        <% end_with %>
    </div>

    <div class="featured-row__secondary">
        <% if $SectionSecondary %>
        <% with $SectionSecondary %>
        <div class="featured-row__secondary-inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(440,280)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:63.6%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
        <% end_with %>
        <% end_if %>
    </div>

</div>

<div class="featured-row__divider"></div>

<%-- SECTION 2: 4-column card grid --%>
<div class="grid-row">

    <div class="grid-row__spacer"></div>

    <%-- Columns 1-2: image cards --%>
    <% loop $SectionImageCards %>
    <div class="grid-row__col">
        <div class="grid-row__inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(540,400)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
    </div>
    <% end_loop %>

    <%-- Column 3: text drawers --%>
    <div class="grid-row__col">
        <div class="grid-row__inner grid-row__inner--text">
            <% loop $SectionDrawersCol3 %>
            <a href="$Link"><div class="grid-row__drawer">
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

    <%-- Column 4: text drawers --%>
    <div class="grid-row__col">
        <div class="grid-row__inner grid-row__inner--text">
            <% loop $SectionDrawersCol4 %>
            <a href="$Link"><div class="grid-row__drawer">
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

</div>

<%-- OVERFLOW ROW 1: Reversed (Drawers, Drawers, Card, Card) --%>
<% loop $GroupedOverflow %>
<div class="grid-row">
    <div class="grid-row__spacer"></div>

    <% if $IsReversed %>
        <%-- REVERSED: 2 text columns on left, 2 image cards on right --%>
        <%-- Column 1: 3 Drawers --%>
        <div class="grid-row__col">
            <div class="grid-row__inner grid-row__inner--text">
                <% loop $Articles.Limit(3) %>
                <a href="$Link"><div class="grid-row__drawer">
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </div></a>
                <% end_loop %>
            </div>
        </div>
        <%-- Column 2: 3 Drawers --%>
        <div class="grid-row__col">
            <div class="grid-row__inner grid-row__inner--text">
                <% loop $Articles.Limit(3,3) %>
                <a href="$Link"><div class="grid-row__drawer">
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </div></a>
                <% end_loop %>
            </div>
        </div>
        <%-- Column 3: Card --%>
        <% loop $Articles.Limit(1,6) %>
        <div class="grid-row__col">
            <div class="grid-row__inner">
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(540,400)
                    <% else %>
                        <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                    <% end_if %>
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </a>
            </div>
        </div>
        <% end_loop %>
        <%-- Column 4: Card --%>
        <% loop $Articles.Limit(1,7) %>
        <div class="grid-row__col">
            <div class="grid-row__inner">
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(540,400)
                    <% else %>
                        <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                    <% end_if %>
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </a>
            </div>
        </div>
        <% end_loop %>

    <% else %>
        <%-- NORMAL: 2 image cards on left, 2 text columns on right --%>
        <%-- Column 1: Card --%>
        <% loop $Articles.Limit(1) %>
        <div class="grid-row__col">
            <div class="grid-row__inner">
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(540,400)
                    <% else %>
                        <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                    <% end_if %>
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </a>
            </div>
        </div>
        <% end_loop %>
        <%-- Column 2: Card --%>
        <% loop $Articles.Limit(1,1) %>
        <div class="grid-row__col">
            <div class="grid-row__inner">
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(540,400)
                    <% else %>
                        <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                    <% end_if %>
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </a>
            </div>
        </div>
        <% end_loop %>

        <%-- Column 3: 3 Drawers --%>
        <div class="grid-row__col">
            <div class="grid-row__inner grid-row__inner--text">
                <% loop $Articles.Limit(3,2) %>
                <a href="$Link"><div class="grid-row__drawer">
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </div></a>
                <% end_loop %>
            </div>
        </div>
        <%-- Column 4: 3 Drawers --%>
        <div class="grid-row__col">
            <div class="grid-row__inner grid-row__inner--text">
                <% loop $Articles.Limit(3,5) %>
                <a href="$Link"><div class="grid-row__drawer">
                    <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
                </div></a>
                <% end_loop %>
            </div>
        </div>
    <% end_if %>

    <%-- Spacer columns if the last row is incomplete --%>
    <% if $Articles.Count == 1 %>
        <div class="grid-row__col"></div><div class="grid-row__col"></div><div class="grid-row__col"></div>
    <% else_if $Articles.Count == 2 %>
        <div class="grid-row__col"></div><div class="grid-row__col"></div>
    <% else_if $Articles.Count == 3 %>
        <div class="grid-row__col"></div>
    <% end_if %>
</div>
<% end_loop %>

<% end_if %>
