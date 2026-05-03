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
        <% if $ArticleAuthor %><div class="art-author">$ArticleAuthor</div><% end_if %>
        <div class="art-date">$Created.Format("EEEE d MMMM Y")</div>
        <div class="share-icons">
            <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
            <a href="#" aria-label="Twitter"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
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
        <p class="art-caption">
            <% if $FeaturedImageCaption %>
                $FeaturedImageCaption
            <% else_if $FeaturedImage %>
                Photograph
            <% end_if %>
        </p>

        <%-- Inline meta: only visible when left col is hidden (mobile) --%>
        <div class="art-inline-meta">
            <% if $ArticleAuthor %><div class="art-author">$ArticleAuthor</div><% end_if %>
            <div class="art-date">$Created.Format("EEEE d MMMM Y")</div>
            <div class="share-icons">
                <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                <a href="#" aria-label="Twitter"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
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
