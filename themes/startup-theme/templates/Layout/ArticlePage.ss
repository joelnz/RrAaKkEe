<script src="$themedResourceURL('js/premium.js')"></script>

<article class="article nw">

    <div class="article__header">
        <div class="article__meta">
            <% if $Category %><a href="#" class="news-cat">$Category</a><% end_if %>
        </div>
        <h1 class="article__title">$Title</h1>
        <% if $Excerpt %><p class="article__standfirst">$Excerpt</p><% end_if %>
        <div class="article__byline">
            <% if $Author %><span class="article__author">$Author</span><% end_if %>
            <span class="article__date">$Created.Format("EEEE d MMMM Y")</span>
        </div>
    </div>

    <% if $FeaturedImage %>
    <div class="article__hero">
        $FeaturedImage.ScaleWidth(1600)
    </div>
    <% end_if %>

    <div class="article__layout">
        <aside class="article__sidebar article__sidebar--left">
            <div class="article__share">
                <p class="article__share-label">Share</p>
                <a href="#" class="article__share-link">Twitter</a>
                <a href="#" class="article__share-link">Facebook</a>
                <a href="#" class="article__share-link">Copy link</a>
            </div>
        </aside>

        <div class="article__body">
            $Content
        </div>

        <aside class="article__sidebar article__sidebar--right">
            <div class="article__related">
                <h4 class="article__related-title">More Stories</h4>
                <% loop $RelatedArticles %>
                    <a href="$Link" class="article__related-item">
                        <% if $FeaturedImage %>$FeaturedImage.Fill(120,80)<% end_if %>
                        <span>$Title</span>
                    </a>
                <% end_loop %>
            </div>
        </aside>
    </div>

</article>
