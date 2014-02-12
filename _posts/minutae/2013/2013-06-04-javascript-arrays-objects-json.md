---
title: Serialize Javascript Array/Objects To JSON & Vice Versa
category: minutae
layout: post
---

###JSON Object###

> The JSON object contains methods for parsing JSON and converting values to
> JSON.

<pre class="brush: javascript">
assert(JSON.stringify({}) === '{}');
assert(JSON.stringify(true) === 'true');
assert(JSON.stringify("foo") === '"foo"');
assert(JSON.stringify([1, "false", false]) === '[1,"false",false]');
assert(JSON.stringify({ x: 5 }) === '{"x":5}');
JSON.stringify({x: 5, y: 6}); // '{"x":5,"y":6}' or '{"y":6,"x":5}'
</pre>

> Return a JSON string corresponding to the specified value, optionally
> including only certain properties or replacing property values in a user-
> defined manner.

<pre class="brush: javascript">
JSON.parse('{}'); // {}
JSON.parse('true'); // true
JSON.parse('"foo"'); // "foo"
JSON.parse('[1, 5, "false"]'); // [1, 5, "false"]
JSON.parse('null'); // null
</pre>

> Parse a string as JSON, optionally transform the produced value and its
> properties, and return the value.

###Browser Compatibility###

[Newer browsers][4] support the [JSON object][1] natively. Well-known polyfills
for the JSON object are [JSON2][5] and [JSON3][6] that will only define
[`JSON.stringify`][2] and [`JSON.parse`][3] if they're not already defined,
leaving any browser native implementation intact.

---

1. [Mozilla Developer Network | JSON][1]
2. [`JSON.stringify` method][2]
3. [`JSON.parse` method][3]
4. [Serializing to JSON in jQuery][7]

[1]: https://developer.mozilla.org/en-US/docs/JSON
[2]: https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/JSON/stringify
[3]: https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/JSON/parse
[4]: http://caniuse.com/json
[5]: https://github.com/douglascrockford/JSON-js
[6]: http://bestiejs.github.io/json3/#section_2
[7]: http://stackoverflow.com/questions/191881/serializing-to-json-in-jquery
