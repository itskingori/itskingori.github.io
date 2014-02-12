---
title: "Fit relative positioned parent to height of absolute positioned child"
category: minutae
layout: post
---

_Parent elements cannot use `"height:auto"` when their children are positioned
absolute/ fixed._

> Absolutely-positioned items are logically-associated with their parent, but
> not "physically". They're not part of the layout, so the parent item can't
> really see how big they are. You need to code the size yourself, or sniff it
> with JavaScript and set it at run-time.

<pre class="brush: js">
var biggestHeight = "0";

// Loop through elements children to find & set the biggest height
$(".container *").each(function(){

    // If this elements height is bigger than the biggestHeight
    if ($(this).height() > biggestHeight ) {

        // Set the biggestHeight to this Height
        biggestHeight = $(this).height();
    }
});

// Set the container height
$(".container").height(biggestHeight);
</pre>

_Ps: The above snippet shows a concept and is not a one-size-fits-all solution.
You need to adapt it to your use case appropriately. I know I did._

---

1. [CSS: fit relative positioned parent to height of absolute positioned child][link1]
2. [Auto height on parent container with Absolute/Fixed Children][link2]

[link1]: http://stackoverflow.com/questions/8577090/css-fit-relative-positioned-parent-to-height-of-absolute-positioned-child
[link2]: http://stackoverflow.com/questions/9061520/auto-height-on-parent-container-with-absolute-fixed-children
