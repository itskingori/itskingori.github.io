---
title: "Audio Formats and Browser Support"
category: minutae
layout: post
---

### Problem

> The `<audio>` and `<video>` elements provide support for playing audio and
> video media without requiring plug-ins. Video codecs and audio codecs are used
> to handle video and audio, and different codecs offer different levels of
> compression and quality. A container format is used to store and transmit the
> coded video and audio together. Many codecs and container formats exists, and
> there are even more combinations of them. For use on the web, only a handful
> of combinations are relevant.

> Different browsers do not support the same media formats in their
> implementations of HTML 5 video and audio, mainly because of patent issues.

### The State Of Things

Currently, there are 3 supported file formats for the `<audio>` element: MP3,
WAV, and OGG:

| Browser               | MP3 | WAV | OGG |
| --------------------- | --- | --- | --- |
| Internet Explorer 9+  | YES | NO  | NO  |
| Chrome 6+             | YES | YES | YES |
| Firefox 3.6+          | NO  | YES | YES |
| Safari 5+             | YES | YES | NO  |
| Opera 10+             | NO  | YES | YES |

_Ps: [See here][3] for a more detailed breakdown of different format
compatibility across different browsers (desktop-mobile, audio-video)._

### Progressing Enhancement/ Graceful Degradation

> If audio support is detected, [Modernizr][6] assesses which formats the
> current browser will play. Currently, [Modernizr][6] tests OGG, MP3, WAV and
> M4A.

> **Important:** The values of these properties are not true booleans. Instead,
> [Modernizr][6] matches the HTML5 spec in returning a string representing the >
browser's level of confidence that it can handle that codec. These return >
values are an empty string (negative response), _"maybe"_ and _"probably"_. >
The empty string is falsy, in other words: `Modernizr.audio.ogg == ''` and > `''
== false`

``` javascript
var audio = new Audio();
audio.src = Modernizr.audio.ogg ? 'background.ogg' :
            Modernizr.audio.mp3 ? 'background.mp3' :
                                  'background.m4a';
audio.play();
```

That allows you to serve the appropriate format based on browser support for a
particular format.

---

1. [W3Schools: HTML5 Audio][1]
2. [Mozilla Developer Network: Media formats supported by the HTML audio and video elements][2]
3. [Wikipedia: HTML5 Audio][4]
4. [Modernizr: HTML5 Features][5]

[1]: http://www.w3schools.com/html/html5_audio.asp
[2]: https://developer.mozilla.org/en-US/docs/HTML/Supported_media_formats
[3]: https://developer.mozilla.org/en-US/docs/HTML/Supported_media_formats#Browser_compatibility
[4]: http://en.wikipedia.org/wiki/HTML5_Audio
[5]: http://modernizr.com/docs/#features-html5
[6]: http://modernizr.com/
