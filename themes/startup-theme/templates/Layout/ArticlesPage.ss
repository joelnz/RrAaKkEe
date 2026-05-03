<script src="$themedResourceURL('js/premium.js')"></script>

<div class="news-section nw">
    <div class="news-section__header">
        <h1 class="news-section__title">$Title</h1>
        <% if $Content %><p class="news-section__desc">$Content.FirstParagraph</p><% end_if %>
    </div>
    <hr class="news-rule">
    <div class="news-grid">
        <% loop $Articles %>
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
