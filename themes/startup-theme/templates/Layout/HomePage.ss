<%-- FIRST SECTION: "Contents" — 8 most recent articles across all sections --%>

<%-- Section 1: Featured row --%>
<div id="section1">

    <div id="col1" class="topleft">
        <div id="inner" class="t">
            <h1>Contents</h1>
            <h3><span>$Now.Format("EEEE")</span><br>$Now.Format("d MMMM Y")</h3>
        </div>
    </div>

    <div id="main-art">
        <% with $FeaturedArticle %>
        <div id="col1">
            <div id="inner3">
                <a href="$Link"><h1>$Title</h1></a>
                <% if $Excerpt %><h2>$Excerpt</h2><% end_if %>
            </div>
        </div>
        <div id="col2" class="b-l">
            <div id="inner2">
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

    <div id="top-art">
        <% with $SecondaryArticle %>
        <div id="inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(440,280)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:63.6%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
        <% end_with %>
    </div>

</div>

<div id="divider"></div>

<%-- Section 2: Card grid with remaining articles --%>
<div id="section2">

    <div class="s2spacer"></div>

    <%-- Columns 1-2: image cards --%>
    <% loop $ImageCardArticles %>
    <div class="s2col">
        <div class="s2inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(540,400)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
    </div>
    <% end_loop %>

    <%-- Column 3: text drawers --%>
    <div class="s2col">
        <div class="s2inner t">
            <% loop $DrawerArticlesCol3 %>
            <a href="$Link"><div class="s2drawer">
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

    <%-- Column 4: text drawers --%>
    <div class="s2col">
        <div class="s2inner t">
            <% loop $DrawerArticlesCol4 %>
            <a href="$Link"><div class="s2drawer">
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

</div>

<%-- PER-SECTION BLOCKS: Fashion, Film, Music, Books, Politics, etc. --%>
<% loop $ArticleSections %>
<% if $SectionFeatured %>

<div id="section1">
    <div id="col1" class="topleft">
        <div id="inner" class="t">
            <h1>$Title</h1>
        </div>
    </div>

    <div id="main-art">
        <% with $SectionFeatured %>
        <div id="col1">
            <div id="inner3">
                <a href="$Link"><h1>$Title</h1></a>
                <% if $Excerpt %><h2>$Excerpt</h2><% end_if %>
            </div>
        </div>
        <div id="col2" class="b-l">
            <div id="inner2">
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

    <div id="top-art">
        <% if $SectionSecondary %>
        <% with $SectionSecondary %>
        <div id="inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(440,280)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:63.6%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
        <% end_with %>
        <% end_if %>
    </div>
</div>

<div id="section2">
    <div class="s2spacer"></div>

    <% loop $SectionImageCards %>
    <div class="s2col">
        <div class="s2inner">
            <a href="$Link">
                <% if $FeaturedImage %>
                    $FeaturedImage.Fill(540,400)
                <% else %>
                    <div class="news-placeholder" style="width:100%;padding-top:74%;"></div>
                <% end_if %>
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </a>
        </div>
    </div>
    <% end_loop %>

    <div class="s2col">
        <div class="s2inner t">
            <% loop $SectionDrawersCol3 %>
            <a href="$Link"><div class="s2drawer">
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>

    <div class="s2col">
        <div class="s2inner t">
            <% loop $SectionDrawersCol4 %>
            <a href="$Link"><div class="s2drawer">
                <h1><% if $Category %><span class="blue">$Category</span> <span class="slash">/ </span><% end_if %>$Title</h1>
            </div></a>
            <% end_loop %>
        </div>
    </div>
</div>

<% end_if %>
<% end_loop %>
