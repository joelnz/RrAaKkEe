<footer class="site-footer">
    <div class="footer-back-to-top">
        <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
            <span class="icon-circle"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 4l-8 8h16l-8-8z"></path></svg></span>
            back to top
        </a>
    </div>
    
    <div class="footer-nav-bar">
        <div class="footer-inner">
            <ul class="footer-sections">
                <% loop $Menu(1) %>
                    <li class="$LinkingMode"><a href="$Link">$MenuTitle</a></li>
                <% end_loop %>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-inner">
            <div class="footer-social">
                <a href="#" class="social-link">facebook</a>
                <a href="#" class="social-link">twitter</a>
            </div>
            
            <div class="footer-credits">
                concept by Joel Cocks 2015 — remade in Silverstripe CMS in 2026 — uses a predictive text algorithm made in 2015
            </div>
        </div>
    </div>
</footer>
