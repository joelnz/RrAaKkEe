<div class="rake-topbar">
    <a href="$BaseHref" class="nav__wordmark">
        <span class="nav__letter nav__letter--rr">Rr</span><span class="nav__letter nav__letter--aa">Aa</span><span class="nav__letter nav__letter--kk">Kk</span><span class="nav__letter nav__letter--ee">Ee</span>
    </a>
    <ul class="nav__sections">
        <% loop $Menu(1) %>
            <li class="nav__section-item $LinkingMode"><a href="$Link">$MenuTitle</a></li>
        <% end_loop %>
    </ul>
</div>

<nav>
    <a href="$BaseHref" class="nav__wordmark">
        <span class="nav__letter nav__letter--rr">Rr</span><span class="nav__letter nav__letter--aa">Aa</span><span class="nav__letter nav__letter--kk">Kk</span><span class="nav__letter nav__letter--ee">Ee</span>
    </a>
    <ul class="nav__sections">
        <% loop $Menu(1) %>
            <li class="nav__section-item $LinkingMode"><a href="$Link">$MenuTitle</a></li>
        <% end_loop %>
    </ul>
</nav>
