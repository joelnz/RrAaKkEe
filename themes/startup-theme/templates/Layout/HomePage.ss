<script src="$themedResourceURL('js/premium.js')"></script>

<div class="news-home nw">

    <div class="news-home__contents">
        <strong>Contents</strong>
        <span>$Now.Format("EEEE d MMMM Y")</span>
    </div>

    <div class="news-featured">

        <div class="news-featured__left">
            <% with $FeaturedArticle %>
                <% if $Category %><span class="news-cat">$Category</span><% end_if %>
                <a href="$Link" class="news-featured__title-link">
                    <h2 class="news-featured__title">$Title</h2>
                </a>
                <% if $Excerpt %><p class="news-featured__excerpt">$Excerpt</p><% end_if %>
                <% if $Author %><span class="news-byline">$Author</span><% end_if %>
            <% end_with %>
        </div>

        <div class="news-featured__center">
            <% with $FeaturedArticle %>
                <a href="$Link">
                    <% if $FeaturedImage %>
                        $FeaturedImage.ScaleWidth(900)
                    <% else %>
                        <div class="news-placeholder" style="height:55rem;"></div>
                    <% end_if %>
                </a>
            <% end_with %>
        </div>

        <div class="news-featured__right">
            <% with $SecondaryArticle %>
                <a href="$Link" class="news-featured__secondary">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(500,380)
                    <% else %>
                        <div class="news-placeholder" style="height:22rem;"></div>
                    <% end_if %>
                    <h3 class="news-featured__secondary-title">$Title</h3>
                    <% if $Author %><span class="news-byline">$Author</span><% end_if %>
                </a>
            <% end_with %>
        </div>

    </div>

    <hr class="news-rule">

    <div class="news-grid">
        <% loop $RecentArticles.exclude('ID', $FeaturedArticle.ID).limit(8) %>
            <a href="$Link" class="news-card">
                <div class="news-card__image">
                    <% if $FeaturedImage %>
                        $FeaturedImage.Fill(400,280)
                    <% else %>
                        <div class="news-placeholder" style="height:18rem;"></div>
                    <% end_if %>
                </div>
                <div class="news-card__body">
                    <% if $Category %><span class="news-cat">$Category</span><% end_if %>
                    <h3 class="news-card__title">$Title</h3>
                    <% if $Excerpt %><p class="news-card__excerpt">$Excerpt</p><% end_if %>
                    <span class="news-byline"><% if $Author %>$Author — <% end_if %>$Created.Format("d MMM Y")</span>
                </div>
            </a>
        <% end_loop %>
    </div>

</div>
