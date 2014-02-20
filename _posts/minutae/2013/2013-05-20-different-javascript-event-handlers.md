---
title: "The Different Javascript Event Handlers"
link: http://net.tutsplus.com/tutorials/javascript-ajax/quick-tip-the-difference-between-live-and-delegate/
category: minutae
layout: post
---

`<ul id="items"><li> Click Me </li></ul>`

> Bind attaches an event handler only to the elements that match a particular
> selector. This, expectedly, excludes any dynamically generated elements.

``` javascript
$("#items li").click(function() {
    $(this).parent().append("<li>New Element</li>");
});
```

> Live(), introduced in 1.3, allows for the binding of event handlers to all
> elements that match a  selector, including those created in the future. It
> does this by attaching the handler to the document. Unfortunately, it does not
> work well with chaining. Don't expect to chain live() after calls like
> children().next()...etc.

``` javascript
$("li").live("click", function() {
    $(this).parent().append("<li>New Element</li>");
});
```

> Delegate, new to version 1.4, perhaps should have been a complete replacement
> for Live(). However, that obviously would have broken a lot of code!
> Nonetheless,  delegate remedies many of the short-comings found in live(). It
> attaches the event handler directly to the context, rather than the document.
> It also doesn't suffer from the chaining issues that live does. There are many
> performance benefits to using this method over live().

``` javascript
$('#items').delegate('li', 'click', function() {
    $(this).parent().append('<li>New Element</li>');
});
```

> By passing a DOM element as the context of our selector, we can make Live()
> behave (almost) the same way that delegate() does. It attaches the handler to
> the context, not the document - which is the default context. The code below
> is equivalent to the delegate() version shown above.

``` javascript
$("li", $("#items")[0]).live("click", function() {
    $(this).parent().append("<li>New Element</li>");
});
```
