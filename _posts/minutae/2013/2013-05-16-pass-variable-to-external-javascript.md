---
title: "Pass Variables To External JS Script"
category: minutae
layout: post
---

### Solution 1:

> You can process those GET parameters on the server where the ***.js is hosted,
> so that it will dynamically change the js file. And your server somehow
> processes the file, replacing that ***.js template file dependent on what
> request was sent.

### Solution 2:

>  Set the global variables on the page where ***.js is loaded, like this. This
>  will then be available in the JS script.

In the HTML document ... somewhere.

```javascript
window.YourVariableName = 'Value';
```

Access it in the script ...

```javascript
var handle = window.YourVariableName || null;
```

---

1. [In Javascript, is it possible to pass a variable into script "src"
   parameter?][1]

[1]: http://stackoverflow.com/questions/4493319/in-javascript-is-it-possible-to-pass-a-variable-into-script-src-parameter?answertab=votes#tab-top
