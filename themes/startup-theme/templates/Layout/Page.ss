<script src="$themedResourceURL('js/premium.js')"></script>

<section class="interior-hero">
    <h1 class="interior-hero__title anim-title">$Title</h1>
    <% if $Content %>
        <p class="interior-hero__desc anim-desc">$Content.FirstParagraph</p>
    <% end_if %>
</section>

<div class="interior-body reveal">
    $Content
</div>
