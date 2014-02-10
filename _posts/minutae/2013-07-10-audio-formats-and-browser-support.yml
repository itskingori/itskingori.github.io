title: "Audio Formats and Browser Support"

published: 2013-07-10T12:00:00+3:00

type: own-post

content: |-

    ###Problem###

    > The `<audio>` and `<video>` elements provide support for playing audio and
    > video media without requiring plug-ins. Video codecs and audio codecs are
    > used to handle video and audio, and different codecs offer different
    > levels of compression and quality. A container format is used to store and
    > transmit the coded video and audio together. Many codecs and container
    > formats exists, and there are even more combinations of them. For use on
    > the web, only a handful of combinations are relevant.

    > Different browsers do not support the same media formats in their
    > implementations of HTML 5 video and audio, mainly because of patent
    > issues.

    ###The State Of Things###

    Currently, there are 3 supported file formats for the `<audio>` element: MP3,
    WAV, and OGG:

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Browser</th>
                <th>MP3</th>
                <th>WAV</th>
                <th>OGG</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Internet Explorer 9+</td>
                <td class="success">YES</td>
                <td class="error">NO</td>
                <td class="error">NO</td>
            </tr>
            <tr>
                <td>Chrome 6+</td>
                <td class="success">YES</td>
                <td class="success">YES</td>
                <td class="success">YES</td>
            </tr>
            <tr>
                <td>Firefox 3.6+</td>
                <td class="error">NO</td>
                <td class="success">YES</td>
                <td class="success">YES</td>
            </tr>
            <tr>
                <td>Safari 5+</td>
                <td class="success">YES</td>
                <td class="success">YES</td>
                <td class="error">NO</td>
            </tr>
            <tr>
                <td>Opera 10+</td>
                <td class="error">NO</td>
                <td class="success">YES</td>
                <td class="success">YES</td>
            </tr>
        </tbody>
    </table>

    _Ps: [See here][3] for a more detailed breakdown of different format
    compatibility across different browsers (desktop-mobile, audio-video)._

    ###Progressing Enhancement/ Graceful Degradation###

    > If audio support is detected, [Modernizr][6] assesses which formats the
    > current browser will play. Currently, [Modernizr][6] tests OGG, MP3, WAV
    > and M4A.

    > **Important:** The values of these properties are not true booleans. Instead,
    > [Modernizr][6] matches the HTML5 spec in returning a string representing the
    > browser's level of confidence that it can handle that codec. These return
    > values are an empty string (negative response), _"maybe"_ and _"probably"_.
    > The empty string is falsy, in other words: `Modernizr.audio.ogg == ''` and
    > `'' == false`

    <pre class="brush: javascript">
    var audio = new Audio();
    audio.src = Modernizr.audio.ogg ? 'background.ogg' :
                Modernizr.audio.mp3 ? 'background.mp3' :
                                      'background.m4a';
    audio.play();
    </pre>

    That allows you to serve the appropriate format based on browser support for
    a particular format.

    <div markdown="1" class="post-footnotes">
    1. [W3Schools | HTML5 Audio][1]
    2. [Mozilla Developer Network | Media formats supported by the HTML audio and video elements][2]
    3. [Wikipedia | HTML5 Audio][4]
    4. [Modernizr | HTML5 Features][5]
    </div>

    [1]: http://www.w3schools.com/html/html5_audio.asp
    [2]: https://developer.mozilla.org/en-US/docs/HTML/Supported_media_formats
    [3]: https://developer.mozilla.org/en-US/docs/HTML/Supported_media_formats#Browser_compatibility
    [4]: http://en.wikipedia.org/wiki/HTML5_Audio
    [5]: http://modernizr.com/docs/#features-html5
    [6]: http://modernizr.com/
