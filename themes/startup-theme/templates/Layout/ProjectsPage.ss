<script src="$themedResourceURL('js/premium.js')"></script>

<section class="projects-intro">
    <span class="projects-intro__label anim-title">— Cat Portfolio</span>
    <h1 class="projects-intro__title anim-title">$Title</h1>
    <p class="projects-intro__desc anim-desc">$Content.FirstParagraph</p>
</section>

<section class="projects-list">
    <% loop $Projects %>
        <a href="$Link" class="projects-list__item reveal">
            <div class="projects-list__image">
                <% if $Images %>
                    $Images.First.Fill(800,600)
                <% else %>
                    <div class="placeholder-img" style="height:40rem;"></div>
                <% end_if %>
            </div>
            <div class="projects-list__info">
                <p class="projects-list__num">0$Pos</p>
                <h2 class="projects-list__title">$Title</h2>
                <% if $Description %>
                    <p class="projects-list__desc">$Description</p>
                <% end_if %>
                <span class="projects-list__arrow">View Project →</span>
            </div>
        </a>
    <% end_loop %>
</section>
