---
title: "Return values of $(selector) if selector doesn't exist?"
link: "http://stackoverflow.com/questions/2076988/why-does-id-return-true-if-id-doesnt-exist"
category: minutae
layout: post
---

###Problem###

Always wondered why jQuery returns true if you are trying to find elements by a
selector that doesn't exist in the DOM structure. Like this example using an id-
selector:

<pre class="brush: html">
<div id="one">one</div>

<script>
console.log( !!$('#one') ) // prints true
console.log( !!$('#two') ) // is also true! (empty jQuery object)
console.log( !!document.getElementById('two') ) // prints false
</script>
</pre>

You can use `!!$('#two').length since length === 0` if the object is empty, but
it seems logical to that a selector would return the element if found, otherwise
null (like the native `document.getElementById` does).

Consequentially, as an example, this logic can't be done in jQuery:

<pre class="brush: javascript">
var div = $('#two') || $('<div id="two"></div>');
</pre>

Wouldn't it be more logical if the id-selector returned null if not found?

###Explanation###

Almost all jQuery functions return a jQuery object as a wrapper around the DOM
elements in question, so you can use dot notation. This behaviour was chosen
because otherwise jQuery would regularly throw errors.

<pre class="brush: javascript">
$("#balloon").css({"color":"red"});
</pre>

Now imagine `$("#balloon")` returned null. That means that
`$("#balloon").css({"color":"red"});` would throw an error, rather than silently
doing nothing as you would normally want.

Hence, you just gotta use .length or .size().

---

1. [Stack Overflow | Why does $('#id') return true if id doesn't exist?][1]

[1]: http://stackoverflow.com/questions/2076988/why-does-id-return-true-if-id-doesnt-exist
