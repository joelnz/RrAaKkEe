<div id="article-wrap">

    <%-- Col 1, Row 1: section label --%>
    <div id="art-col1-top">
        <% if $Category %>
            <span class="art-section-label">$Category</span>
        <% else %>
            <span class="art-section-label">Article</span>
        <% end_if %>
    </div>

    <%-- Col 2, Row 1: headline + standfirst --%>
    <div id="art-col2-top">
        <h1 class="art-headline">$Title</h1>
        <% if $Excerpt %><p class="art-standfirst">$Excerpt</p><% end_if %>
    </div>

    <%-- Col 1, Row 2: author / date / share --%>
    <div id="art-col1-bottom">
        <% if $Author %><div class="art-author">$Author</div><% end_if %>
        <div class="art-date">$Created.Format("EEEE d MMMM Y")</div>
        <div class="share-icons">
            <a href="#">f</a>
            <a href="#">t</a>
        </div>
    </div>

    <%-- Col 2, Row 2: image + caption + body --%>
    <div id="art-col2-bottom">
        <div class="art-hero">
            <% if $FeaturedImage %>
                $FeaturedImage.ScaleWidth(1600)
            <% else %>
                <div class="news-placeholder" style="width:100%;padding-top:66.66%;"></div>
            <% end_if %>
        </div>
        <p class="art-caption"><% if $FeaturedImage %>Photograph<% end_if %></p>

        <%-- Inline meta: only visible when left col is hidden (mobile) --%>
        <div class="art-inline-meta">
            <% if $Author %><div class="art-author">$Author</div><% end_if %>
            <div class="art-date">$Created.Format("EEEE d MMMM Y")</div>
            <div class="share-icons">
                <a href="#">f</a>
                <a href="#">t</a>
            </div>
        </div>

        <div class="art-body">
            $Content
        </div>
    </div>

    <%-- Col 3, Rows 1+2: Related --%>
    <div id="art-sidebar">
        <h4 class="sidebar-heading">Related</h4>
        <% loop $RelatedArticles %>
        <a href="$Link"><div class="related-item">
            <% if $FeaturedImage %>
                $FeaturedImage.Fill(72,54)
            <% else %>
                <div class="news-placeholder" style="width:72px;height:54px;flex-shrink:0;"></div>
            <% end_if %>
            <h5>$Title</h5>
        </div></a>
        <% end_loop %>
    </div>

</div>
