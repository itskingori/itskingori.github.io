---
title: HTTPUrlConnection hangs when attempting to getResponseCode() on Android
category: minutae
layout: post
---

There is a small issue that causes HTTPUrlConnection to hang when trying to
retrieve the response code via `getResponseCode()` after which an Exception is
thrown.

In my case I was authenticating against an oAuth Server and expecting a 401
error. As per [RFC2617](http://www.ietf.org/rfc/rfc2617.txt):

> The 401 (Unauthorized) response message is used by an origin server to
> challenge the authorization of a user agent. This response **MUST** include a
> WWW-Authenticate header field containing at least one challenge applicable to
> the requested resource.

Which simply means the response **must** include the `WWW-Authenticate` header
set without which the method throws `java.io.IOException: No authentication
challenges found`.

```
header('WWW-Authenticate: OAuth realm="users"');
header('HTTP/1.1 401 Unauthorized');
```

So far, this is normal and expected.

On Android, the lack of "" wrapping on realm caused the app to hang at the
`getResponseCode()` attempt, therefore crashing the app ... so use this
`realm="..."` instead of `realm=...` if you own the server-side API.

Looking at the [spec](http://tools.ietf.org/html/rfc2617#section-3.2.1) they
seem to imply that the values should be in quotes ... but its not 100% clear.

---

1. [HttpURLConnection worked fine in Android 2.x but NOT in 4.1: No ...](http://stackoverflow.com/questions/11810447/httpurlconnection-worked-fine-in-android-2-x-but-not-in-4-1-no-authentication-c)
2. [The WWW-Authenticate Response Header spec](http://tools.ietf.org/html/rfc2617#section-3.2.1)
