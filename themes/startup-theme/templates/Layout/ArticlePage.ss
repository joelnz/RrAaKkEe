<div class="article">
    <%-- Col 1, Row 1: section label --%>
    <div class="article__meta">
        <% if $Category %>
            <span class="article__section-label">$Category</span>
        <% else %>
            <span class="article__section-label">Article</span>
        <% end_if %>
    </div>

    <%-- Col 2, Row 1: headline + standfirst --%>
    <div class="article__header">
        <h1 class="article__title">$Title</h1>
        <% if $Excerpt %><p class="article__standfirst">$Excerpt</p><% end_if %>
    </div>

    <%-- Col 1, Row 2: author / date / share --%>
    <div class="article__byline">
        <% if $ArticleAuthor %><div class="article__author">$ArticleAuthor</div><% end_if %>
        <div class="article__date">$Created.Format("EEEE d MMMM Y")</div>
        <div class="article__share">
            <a href="#" class="article__share-link" aria-label="Facebook"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
            <a href="#" class="article__share-link" aria-label="Twitter"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
        </div>
    </div>

    <%-- Col 2, Row 2: image + caption + body --%>
    <div class="article__content">
        <div class="article__hero">
            <% if $FeaturedImage %>
                $FeaturedImage.ScaleWidth(1600)
            <% else %>
                <div class="news-placeholder" style="width:100%;padding-top:66.66%;"></div>
            <% end_if %>
        </div>
        <p class="article__caption">
            <% if $FeaturedImageCaption %>
                $FeaturedImageCaption
            <% else_if $FeaturedImage %>
                Photograph
            <% end_if %>
        </p>

        <%-- Inline meta: only visible when left col is hidden (mobile) --%>
        <div class="article__inline-meta">
            <% if $ArticleAuthor %><div class="article__author">$ArticleAuthor</div><% end_if %>
            <div class="article__date">$Created.Format("EEEE d MMMM Y")</div>
            <div class="article__share">
                <a href="#" class="article__share-link" aria-label="Facebook"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                <a href="#" class="article__share-link" aria-label="Twitter"><svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
            </div>
        </div>

        <div class="article__body">
            $Content
        </div>
    </div>

    <%-- Col 3, Rows 1+2: Related --%>
    <div class="article__sidebar">
        <h4 class="article__sidebar-title">Related</h4>
        <% loop $RelatedArticles %>
        <a href="$Link"><div class="article__related">
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
