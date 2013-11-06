title: "Pass Variables To External JS Script"

published: 2013-05-16T12:00:00+3:00

type: own-post

content: |-

    ###Solution 1:###

    > You can process those GET parameters on the server where the ***.js is
    > hosted, so that it will dynamically change the js file. And your server
    > somehow processes the file, replacing that ***.js template file
    > dependent on what request was sent.

    ###Solution 2:###

    >  Set the global variables on the page where ***.js is loaded, like this.
    >  This will then be available in the JS script.

    In the HTML document ... somewhere.

    <pre class="brush: javascript">
    window.YourVariableName = 'Value';
    </pre>

    Access it in the script ...

    <pre class="brush: javascript">
    var handle = window.YourVariableName || null;
    </pre>

    <div markdown="1" class="post-footnotes">
    1. [In Javascript, is it possible to pass a variable into script “src” parameter?][1]
    </div>

    [1]: http://stackoverflow.com/questions/4493319/in-javascript-is-it-possible-to-pass-a-variable-into-script-src-parameter?answertab=votes#tab-top
