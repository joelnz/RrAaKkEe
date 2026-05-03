<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\LiteralField;
    use SilverStripe\View\Requirements;

    class HomePage extends SiteTree
    {
        private static $singular_name = 'Home Page';
        private static $description = 'The site homepage';

        public function getRecentArticles()
        {
            return ArticlePage::get()->sort('Created DESC')->limit(10);
        }

        public function getFeaturedArticle()
        {
            return ArticlePage::get()->sort('Created DESC')->first();
        }

        public function getSecondaryArticle()
        {
            $featured = $this->getFeaturedArticle();
            if (!$featured) return null;
            return ArticlePage::get()->exclude('ID', $featured->ID)->sort('Created DESC')->first();
        }

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            Requirements::customCSS('
                #rake-site-generator { font-family: Helvetica Neue, Helvetica, Arial, sans-serif; padding: 20px; }
                #rake-site-generator h3 { font-size: 18px; font-weight: 600; margin: 0 0 6px; }
                #rake-site-generator p.rake-hint { font-size: 12px; color: #666; margin: 0 0 14px; line-height: 1.5; }
                #rake-site-source { width: 100%; height: 220px; font-size: 13px; padding: 10px; border: 1px solid #ccc; resize: vertical; box-sizing: border-box; font-family: inherit; line-height: 1.5; }
                .rake-btns { margin-top: 10px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
                .rake-btn { padding: 9px 22px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; letter-spacing: 0.04em; text-transform: uppercase; }
                .rake-btn--add  { background: #333; color: #fff; }
                .rake-btn--add:hover  { background: #000; }
                .rake-btn--regen { background: #c0392b; color: #fff; }
                .rake-btn--regen:hover { background: #96281b; }
                .rake-btn:disabled { opacity: 0.35; cursor: not-allowed; }
                #rake-site-status { margin-top: 14px; font-size: 13px; color: #555; min-height: 20px; }
                #rake-site-wordcount { font-size: 12px; color: #888; }
            ', 'rake-site-generator-css');

            Requirements::customScript('
                (function() {
                    "use strict";

                    window._rakeSiteRaw = window._rakeSiteRaw || "";

                    function setStatus(msg, colour) {
                        var el = document.getElementById("rake-site-status");
                        if (el) { el.textContent = msg; el.style.color = colour || "#555"; }
                    }

                    // Capture phase: store raw text BEFORE the main listener clears the field
                    document.addEventListener("click", function(e) {
                        if (e.target && e.target.id === "rake-site-add") {
                            var source = document.getElementById("rake-site-source");
                            if (source && source.value.trim()) {
                                window._rakeSiteRaw += " " + source.value.trim();
                            }
                        }
                    }, true);

                    document.addEventListener("click", function(e) {
                        var id = e.target && e.target.id;

                        if (id === "rake-site-add") {
                            e.preventDefault();
                            var source = document.getElementById("rake-site-source");
                            if (!source || !source.value.trim()) {
                                setStatus("Paste some text first.", "#c0392b");
                                return;
                            }
                            var wordCount = source.value.trim().split(/\s+/).length;
                            var total = window._rakeSiteRaw.trim().split(/\s+/).length;
                            var wc = document.getElementById("rake-site-wordcount");
                            if (wc) wc.textContent = total.toLocaleString() + " words in chain";
                            setStatus("Added " + wordCount + " words. Add more or click Regenerate All.");
                            source.value = "";
                        }

                        if (id === "rake-site-regen") {
                            e.preventDefault();
                            var raw = window._rakeSiteRaw.trim();
                            if (!raw) {
                                setStatus("Add some source text first.", "#c0392b");
                                return;
                            }

                            var btn = document.getElementById("rake-site-regen");
                            if (btn) btn.disabled = true;
                            setStatus("Regenerating all articles…", "#1a7abf");

                            fetch("/article-generator/generate", {
                                method: "POST",
                                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                body: "text=" + encodeURIComponent(raw)
                            })
                            .then(function(r) { return r.json(); })
                            .then(function(data) {
                                if (data.success) {
                                    setStatus("Done — " + data.updated + " articles regenerated. Reload any article page to see the new content.", "#27ae60");
                                } else {
                                    setStatus("Error: " + (data.error || "unknown error"), "#c0392b");
                                }
                                if (btn) btn.disabled = false;
                            })
                            .catch(function(err) {
                                setStatus("Request failed — " + err, "#c0392b");
                                if (btn) btn.disabled = false;
                            });
                        }
                    });
                })();
            ', 'rake-site-generator-js');

            $articleCount = ArticlePage::get()->count();

            $html = '
                <div id="rake-site-generator">
                    <h3>Regenerate All Articles</h3>
                    <p class="rake-hint">
                        Paste a large body of text — a novel, articles, essays — and click <strong>Add to chain</strong>.<br>
                        You can add multiple pastes to build a richer chain. Then click <strong>Regenerate All</strong>
                        to overwrite the Title, Excerpt and Content of all <strong>' . $articleCount . ' articles</strong> on the site.
                    </p>
                    <textarea id="rake-site-source" placeholder="Paste source text here…"></textarea>
                    <div class="rake-btns">
                        <button type="button" class="rake-btn rake-btn--add" id="rake-site-add">Add to chain</button>
                        <button type="button" class="rake-btn rake-btn--regen" id="rake-site-regen">Regenerate all ' . $articleCount . ' articles</button>
                        <span id="rake-site-wordcount"></span>
                    </div>
                    <div id="rake-site-status"></div>
                </div>
            ';

            $fields->addFieldToTab('Root.Generator', LiteralField::create('RakeSiteGenerator', $html));

            return $fields;
        }
    }
}
