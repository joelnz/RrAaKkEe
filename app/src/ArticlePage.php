<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Assets\Image;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\TextareaField;
    use SilverStripe\Forms\LiteralField;
    use SilverStripe\View\Requirements;

    class ArticlePage extends SiteTree
    {
        private static $singular_name = 'Article';
        private static $description = 'A news article';

        private static $db = [
            'Author'   => 'Varchar(255)',
            'Category' => 'Varchar(100)',
            'Excerpt'  => 'Text',
            'FeaturedImageCaption' => 'Varchar(255)',
        ];

        private static $has_one = [
            'FeaturedImage' => Image::class,
        ];

        private static $owns = ['FeaturedImage'];

        public function getRelatedArticles()
        {
            return ArticlePage::get()->exclude('ID', $this->ID)->sort('Created DESC')->limit(4);
        }

        public function getArticleAuthor()
        {
            return $this->getField('Author');
        }

        public function onBeforeWrite()
        {
            parent::onBeforeWrite();
            if (!$this->Author) {
                $this->Author = 'Annonymos Ghost';
            }
        }

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            $fields->addFieldToTab('Root.Main', TextField::create('Author', 'Author'), 'Content');
            $fields->addFieldToTab('Root.Main', TextField::create('Category', 'Category'), 'Content');
            $fields->addFieldToTab('Root.Main', TextareaField::create('Excerpt', 'Excerpt (short summary)'), 'Content');
            $upload = UploadField::create('FeaturedImage', 'Featured Image');
            $upload->setFolderName('articles');
            $fields->addFieldToTab('Root.Main', $upload, 'Content');
            $fields->addFieldToTab('Root.Main', TextField::create('FeaturedImageCaption', 'Featured Image Caption'), 'Content');

            // Generator tab
            Requirements::customCSS('
                #rake-generator { font-family: Helvetica Neue, Helvetica, Arial, sans-serif; padding: 20px; }
                #rake-generator h3 { font-size: 18px; font-weight: 600; margin: 0 0 6px; }
                #rake-generator p.rake-hint { font-size: 12px; color: #666; margin: 0 0 14px; line-height: 1.5; }
                #rake-source { width: 100%; height: 220px; font-size: 13px; padding: 10px; border: 1px solid #ccc; resize: vertical; box-sizing: border-box; font-family: inherit; line-height: 1.5; }
                .rake-btns { margin-top: 10px; display: flex; gap: 10px; align-items: center; }
                .rake-btn { padding: 9px 22px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; letter-spacing: 0.04em; text-transform: uppercase; }
                .rake-btn--add { background: #333; color: #fff; }
                .rake-btn--add:hover { background: #000; }
                .rake-btn--gen { background: #1a7abf; color: #fff; }
                .rake-btn--gen:hover { background: #1464a0; }
                .rake-btn:disabled { opacity: 0.35; cursor: not-allowed; }
                #rake-status { margin-top: 14px; font-size: 13px; color: #555; min-height: 20px; }
                #rake-wordcount { font-size: 12px; color: #888; margin-left: auto; }
            ', 'rake-generator-css');

            Requirements::customScript('
                (function() {
                    "use strict";

                    // Chain state lives here — persists across React re-renders
                    var cache = { "_START": [] };
                    var totalWords = 0;

                    function buildChain(text) {
                        var words = text.split(/\s+/).filter(function(w){ return w.length > 0; });
                        if (!words.length) return 0;
                        cache["_START"].push(words[0]);
                        for (var i = 0; i < words.length - 1; i++) {
                            if (!cache[words[i]]) cache[words[i]] = [];
                            cache[words[i]].push(words[i + 1]);
                            if (words[i].match(/[.!?]$/)) cache["_START"].push(words[i + 1]);
                        }
                        return words.length;
                    }

                    function generate(wordCount) {
                        if (!cache["_START"].length) return "";
                        var cur = "_START", str = "";
                        for (var i = 0; i < wordCount; i++) {
                            var pool = cache[cur];
                            if (!pool || !pool.length) break;
                            var w = pool[Math.floor(Math.random() * pool.length)];
                            str += w;
                            if (!cache[w]) { cur = "_START"; str += ". "; }
                            else { cur = w; str += " "; }
                        }
                        return str;
                    }

                    function setStatus(msg, colour) {
                        var el = document.getElementById("rake-status");
                        if (el) { el.textContent = msg; el.style.color = colour || "#555"; }
                    }

                    function fillCMSField(id, value) {
                        var el = document.getElementById(id);
                        if (el) {
                            el.value = value;
                            el.dispatchEvent(new Event("change", { bubbles: true }));
                            el.dispatchEvent(new Event("input",  { bubbles: true }));
                        }
                    }

                    function fillTinyMCE(value) {
                        if (!window.tinymce) return false;
                        // Try direct ID first
                        var direct = tinymce.get("Form_EditForm_Content");
                        if (direct) { direct.setContent(value); return true; }
                        // Try any editor whose ID contains "Content"
                        var eds = tinymce.editors;
                        for (var i = 0; i < eds.length; i++) {
                            if (eds[i].id && eds[i].id.indexOf("Content") !== -1) {
                                eds[i].setContent(value); return true;
                            }
                        }
                        // Last resort: just use the first available editor
                        if (eds.length > 0) { eds[0].setContent(value); return true; }
                        return false;
                    }

                    function fillContentField(value) {
                        // Try TinyMCE
                        if (fillTinyMCE(value)) return;
                        // Fallback: find any textarea or div that looks like the content area
                        var candidates = [
                            document.getElementById("Form_EditForm_Content"),
                            document.querySelector("textarea[name=Content]"),
                            document.querySelector(".mce-content-body"),
                            document.querySelector("[data-field-id=Content] textarea"),
                            document.querySelector("[id$=_Content]")
                        ];
                        for (var i = 0; i < candidates.length; i++) {
                            if (candidates[i]) {
                                candidates[i].value !== undefined
                                    ? (candidates[i].value = value)
                                    : (candidates[i].innerHTML = value);
                                candidates[i].dispatchEvent(new Event("change", { bubbles: true }));
                                return;
                            }
                        }
                    }

                    function handleAdd() {
                        var source = document.getElementById("rake-source");
                        if (!source) return;
                        var text = source.value.trim();
                        if (!text) { setStatus("Paste some text first.", "#c0392b"); return; }
                        var n = buildChain(text);
                        totalWords += n;
                        var wc = document.getElementById("rake-wordcount");
                        if (wc) wc.textContent = totalWords.toLocaleString() + " words in chain";
                        setStatus("Added " + n + " words. Paste more to enrich the chain, or click Generate.");
                        source.value = "";
                        // Visually enable the generate button
                        var genBtn = document.getElementById("rake-generate");
                        if (genBtn) genBtn.disabled = false;
                    }

                    function handleGenerate() {
                        if (!cache["_START"].length) {
                            setStatus("Add some source text first.", "#c0392b");
                            return;
                        }
                        var raw = generate(3000);
                        var sents = raw.match(/[^.!?]+[.!?]+/g) || [];
                        if (sents.length < 8) {
                            setStatus("Not enough source text — add more!", "#c0392b");
                            return;
                        }

                        // Title: first mid-length sentence
                        var title = "";
                        for (var i = 2; i < sents.length; i++) {
                            var t = sents[i].trim();
                            if (t.length > 20 && t.length < 90) { title = t; break; }
                        }
                        if (!title) title = sents[3].trim();

                        // Excerpt: 1 sentence
                        var excerpt = sents[0].trim();

                        // Caption: 1 sentence
                        var caption = sents[1] ? sents[1].trim() : sents[0].trim();

                        // Body: 4 paragraphs of 3 sentences each = ~12 sentences total
                        var body = "";
                        var bodyStart = 4;
                        for (var j = 0; j < 4; j++) {
                            var para = "";
                            for (var k = 0; k < 3; k++) {
                                var idx = bodyStart + j * 3 + k;
                                if (idx < sents.length) para += sents[idx].trim() + " ";
                            }
                            if (para.trim()) body += "<p>" + para.trim() + "</p>\\n";
                        }

                        fillCMSField("Form_EditForm_Title", title);
                        fillCMSField("Form_EditForm_Excerpt", excerpt);
                        fillCMSField("Form_EditForm_FeaturedImageCaption", caption);
                        fillContentField(body);

                        var editorIds = window.tinymce ? tinymce.editors.map(function(e){ return e.id; }).join(", ") : "no tinymce";
                        setStatus("Done — check Main tab. Editors found: [" + editorIds + "]", "#27ae60");
                    }

                    // Single delegated listener on the document — survives React re-renders
                    document.addEventListener("click", function(e) {
                        var id = e.target && e.target.id;
                        if (id === "rake-add")      { e.preventDefault(); handleAdd(); }
                        if (id === "rake-generate") { e.preventDefault(); handleGenerate(); }
                    });
                })();
            ', 'rake-generator-js');

            $generatorHTML = '
                <div id="rake-generator">
                    <h3>Markov Chain Generator</h3>
                    <p class="rake-hint">
                        Paste any body of text — articles, a novel, essays — and click <strong>Add to chain</strong>.<br>
                        Add as much as you like from multiple pastes. Then click <strong>Generate</strong> to fill the Title, Excerpt and Content fields.
                    </p>
                    <textarea id="rake-source" placeholder="Paste source text here…"></textarea>
                    <div class="rake-btns">
                        <button type="button" class="rake-btn rake-btn--add" id="rake-add">Add to chain</button>
                        <button type="button" class="rake-btn rake-btn--gen" id="rake-generate">Generate</button>
                        <span id="rake-wordcount"></span>
                    </div>
                    <div id="rake-status"></div>
                </div>
            ';

            $fields->addFieldToTab('Root.Generator', LiteralField::create('RakeGenerator', $generatorHTML));

            return $fields;
        }
    }
}
