---
title: "Javascript Variable Hoisting"
category: minutae
layout: post
---

### Example Problem:

Global variable has undefined in certain case.

``` javascript
var value = 10;

function test() {

    //A
    console.log(value);

    //B
    var value = 20;
    console.log(value);
}

test();
```

Gives output as.

``` javascript
undefined
20
```

### Explanation

This phenomenon is known as __Javascript Variable Hoisting__. At no point are
you accessing the global variable in your function; you're only ever
accessing the local value variable. Your code is equivalent to the
following:

``` javascript
var value = 10;

function test() {

    var value;
    console.log(value);

    var value = 20;
    console.log(value);
}

test();
```

#### Simple Explanation:

> Variables in JavaScript always have function-wide scope. Even if they were
> defined in the middle of the function, they are visible before. Similar
> phenomena may be observed with function hoisting.

> That being said, the first `console.log(value)` sees the value variable (the
> inner one which shadows the outer value), but it has not yet been initialized.
> You can think of it as if all variable declarations were implicitly moved to
> the beginning of the function (not inner-most code block), while the
> definitions are left on the same place.

``` javascript
(function() {

    var a = 'a';
    // lines of code

    var b = 'b';
    // more lines of code

    var c= 'c'; // antipattern
    // final lines of scripting
})();
```

Will be rewritten by the interpreter as;

``` javascript
(function() {

    var a, b, c; // variables declared

    a = 'a';
    // lines of code

    b = 'b'; // initialized
    // more lines of code

    c= 'c'; // initialized
    // final lines of scripting
})();
```

#### Complex Explanation:

> This is something that every Javascript programmer bumps into sooner or later.
> Simply put, whatever variables you declare are always hoisted to the top of
> your local closure. So, even though you declared your variable after the first
> `console.log` call, it's still considered as if you had declared it before
> that. However, only the declaration part is being hoisted; the assignment, on
> the other hand, is not.

> So, when you first called `console.log(value)`, you were referencing your
> locally declared variable, which has got nothing assigned to it yet; hence
> undefined.

#### Other: Function Hoisting

Function hoisting means that functions are moved to the top of their scope. That
is;

``` javascript
function b() {
    a = 10;
    return;
    function a() {}
}
```

Will be rewritten by the interpreter as;

``` javascript
function b() {
    function a() {}
    a = 10;
    return;
}
```

Also;

``` javascript
function a() {}
```

behaves the same as;

``` javascript
var a = function () {};
```

So all the function declarations are eventually assigned to a variable. In
Javascript, functions are first class objects, just like strings and numbers.
That means they are defined as variables and can be passed to other functions,
be stored in arrays, and so on.

---

1. [Adequately Good Decent Programming Advice: JavaScript Scoping and Hoisting][1]
2. [Nettuts: Quick Tip: JavaScript Hoisting Explained][2]
3. [Stack Overflow: Surprised that global variable has undefined value in JavaScript][3]
4. [Stack Overflow: Javascript function scoping and hoisting][4]
5. [Stack Overflow: Javascript variable declarations at the head of a function][5]

[1]: http://www.adequatelygood.com/JavaScript-Scoping-and-Hoisting.html
[2]: http://net.tutsplus.com/tutorials/javascript-ajax/quick-tip-javascript-hoisting-explained/
[3]: http://stackoverflow.com/questions/9085839/surprised-that-global-variable-has-undefined-value-in-
[4]: http://stackoverflow.com/questions/7506844/javascript-function-scoping-and-hoisting
[5]: http://stackoverflow.com/questions/8351293/javascript-variable-declarations-at-the-head-of-a-function
