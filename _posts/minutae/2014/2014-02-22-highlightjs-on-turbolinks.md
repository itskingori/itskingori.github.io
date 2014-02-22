---
title: Highlight.js & Turbolinks
link: http://highlightjs.org/usage/
category: minutae
layout: post
---

Seems like [highlight.js][1] relies on the conventional on the `ready()` event
(or something close to that) to trigger ... which is obviously broken by
[Turbolinks][2].

``` javascript
$(document).on('page:change',  function() {
  hljs.initHighlightingOnLoad();
});
$(document).on('page:restore', function() {
  hljs.initHighlightingOnLoad();
});
```

Instead do this ...

``` javascript
$(document).on('page:change',  function() {
  $('pre code').each(function(i, e) {hljs.highlightBlock(e)});
});
$(document).on('page:restore', function() {
  $('pre code').each(function(i, e) {hljs.highlightBlock(e)});
});
```

[1]: http://highlightjs.org/usage/
[2]: https://github.com/rails/turbolinks

