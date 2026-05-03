<%-- FIRST SECTION: "Contents" — 8 most recent articles across all sections --%>

<%-- Section 1: Featured row --%>
<div class="featured-row">

    <div class="featured-row__label">
        <div class="featured-row__label-inner">
            <h1>Contents</h1>
            <h3><span>$Now.Format("EEEE")</span><br>$Now.Format("d MMMM Y")</h3>
        </div>
    </div>

    <div class="featured-row__main">
        <% with $FeaturedArticle %>
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
        <% with $SecondaryArticle %>
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
    </div>

</div>

<div class="featured-row__divider"></div>

<%-- Section 2: Card grid with remaining articles --%>
<div class="grid-row">

    <div class="grid-row__spacer"></div>

    <%-- Columns 1-2: image cards --%>
    <% loop $ImageCardArticles %>
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
            <% loop $DrawerArticlesCol3 %>
            <a href="$Link"><div class="grid-row__drawer">
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

    <%-- Column 4: text drawers --%>
    <div class="grid-row__col">
        <div class="grid-row__inner grid-row__inner--text">
            <% loop $DrawerArticlesCol4 %>
            <a href="$Link"><div class="grid-row__drawer">
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

</div>

<%-- PER-SECTION BLOCKS: Fashion, Film, Music, Books, Politics, etc. --%>
<% loop $ArticleSections %>
<% if $SectionFeatured %>

<div class="featured-row">
    <div class="featured-row__label">
        <div class="featured-row__label-inner">
            <h1>$Title</h1>
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

<div class="grid-row">
    <div class="grid-row__spacer"></div>

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

    <div class="grid-row__col">
        <div class="grid-row__inner grid-row__inner--text">
            <% loop $SectionDrawersCol3 %>
            <a href="$Link"><div class="grid-row__drawer">
                <h1><% if $Category %><span class="cat-label">$Category</span> <span class="cat-sep">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

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

<% end_if %>
<% end_loop %>
