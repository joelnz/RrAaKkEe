<script src="$themedResourceURL('js/premium.js')"></script>

<div class="project-detail">

    <div class="project-detail__intro">
        <h1 class="project-detail__title anim-title">$Title</h1>
        <% if $Description %>
            <p class="project-detail__desc anim-desc">$Description</p>
        <% end_if %>
    </div>

    <div class="project-detail__hero anim-img">
        <% if $Images %>
            $Images.First.ScaleWidth(1920)
        <% else %>
            <div class="placeholder-img" style="height:80vh;"></div>
        <% end_if %>
    </div>

    <% if $Images.Count > 1 %>
        <div class="project-detail__gallery">
            <% loop $Images %>
                <% if $Pos > 1 %>
                    <div class="project-detail__gallery-item reveal">
                        $ScaleWidth(1200)
                    </div>
                <% end_if %>
            <% end_loop %>
        </div>
    <% end_if %>

</div>
