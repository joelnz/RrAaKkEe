<header class="site-header">

    <div class="masthead nw">
        <a href="$BaseHref" class="masthead__wordmark" aria-label="Rake">
            <span>Rr</span><span>Aa</span><span>Kk</span><span>Ee</span>
        </a>
    </div>

    <nav class="header-nav">
        <div class="header-nav__inner nw">
            <ul class="header-nav__list">
                <% loop $Menu(1) %>
                    <li class="header-nav__item<% if $LinkingMode == 'current' %> header-nav__item--current<% end_if %>">
                        <a href="$Link" class="header-nav__link">$MenuTitle</a>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </nav>

</header>
