# RrAaKkEe

**RrAaKkEe** is a collage experiment.

## The Concept

I started this in 2015. The idea was that I  feed the generator samples of writing (news articles, books, essays) and click Generate. It produces new text based on the probability of what word would come next. I paired the output with my own photos from Flickr. The titles that came out were often fun and weirdly poetic, and I liked seeing what unexpected image combinations would appear.

The name comes from the garden tool — raking everything in together.

In 2026 I remade the whole project in **SilverStripe CMS** to prepare for an interview at **AKQA**.

## Technical Details

- **Custom Design:** Built the layout from scratch in pure CSS - its loosly based on a 2015 version of the Guardian's website.
- **CMS:** Used SilverStripe to create custom page types for articles, with fields like Image Captions to keep the admin panel straightforward.
- **Built-in Generator:** The original 2015 probability logic lives inside the CMS. A Generate button in the admin panel instantly creates a dummy article (title, excerpt, and body) for testing how layouts look with content in them.

## Tech Stack

- **CMS:** SilverStripe 6 (PHP 8)
- **Styles:** Vanilla CSS3
- **Logic:** Vanilla JavaScript

## How to Run

1. `composer install`
2. Set up your `.env` file
3. Run `vendor/bin/sake dev/build flush=all`
4. Log into `/admin` to see the generator
