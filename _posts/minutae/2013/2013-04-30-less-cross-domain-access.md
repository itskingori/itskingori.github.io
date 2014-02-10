---
title: "Loading LESS files from Amazon S3 (cross-domain)"
category: minutae
---

###Problem###

If you have a static file server on S3 ... this loads fine:

<pre class="brush: css">
<link rel="stylesheet" href="http://static.example.com/css/screen.less" type="text/css" media="screen, projection, print">
</pre>

This ... does not load.

<pre class="brush: css">
<link rel="stylesheet/less" href="http://static.example.com/css/screen.less" type="text/css" media="screen, projection, print">
</pre>

###Reason###

> Cross-site HTTP requests are HTTP requests for resources from a different
> domain than the domain of the resource making the request.  For instance,
> a resource loaded from Domain A (http://domaina.example) such as an HTML
> web page, makes a request for a resource on Domain B (http://domainb.foo),
> such as an image, using the img element (http://domainb.foo/image.jpg).
> This occurs very commonly on the web today — pages load a number of
> resources in a cross-site manner, including CSS stylesheets, images and
> scripts, and other resources.

> Cross-site HTTP requests initiated from within scripts have been subject
> to well-known restrictions, for well-understood security reasons.  For
> example HTTP Requests made using the XMLHttpRequest object were subject to
> the same-origin policy.  In particular, this meant that a web application
> using XMLHttpRequest could only make HTTP requests to the domain it was
> loaded from, and not to other domains.  Developers expressed the desire to
> safely evolve capabilities such as XMLHttpRequest to make cross-site
> requests, for better, safer mash-ups within web applications.

[Read more here ...][link4]

###Fix (Amazon S3 Only)###

If you're using Amazon S3, they [announced Cross-Origin Resource Sharing
(CORS) support][link2] ... enable cross domain using a CORs policy just like
the one below ... (for GET requests, see official documentation for more
examples and details).

<pre class="brush: xml">
    <CORSConfiguration>
        <CORSRule>
            <AllowedOrigin>http://domain1.com</AllowedOrigin>
            <AllowedOrigin>http://domain2</AllowedOrigin>
            <AllowedMethod>GET</AllowedMethod>
            <AllowedHeader>*</AllowedHeader>
            <MaxAgeSeconds>3000</MaxAgeSeconds>
            <ExposeHeader>x-amz-server-side-encryption</ExposeHeader>
            <ExposeHeader>x-amz-request-id</ExposeHeader>
            <ExposeHeader>x-amz-id-2</ExposeHeader>
        </CORSRule>
    </CORSConfiguration>
</pre>

S3 will then send the appropriate [`The_HTTP_response_headers`][link6].

<div markdown="1" class="post-footnotes">
1. [In-browser rel="stylesheet/less" not loading from static file server][link1]
2. [Announcement: Announcing Amazon S3 Support for Cross-Origin Resource Sharing (CORS)][link2]
3. [How Do I Enable CORS On My Bucket?][link3]
4. [HTTP access control (CORS)][link4] - [Mozilla Developer Network][link5]
</div>

[link1]: https://github.com/cloudhead/less.js/issues/161
[link2]: https://forums.aws.amazon.com/ann.jspa?annID=1620
[link3]: http://docs.aws.amazon.com/AmazonS3/latest/dev/cors.html#how-do-i-enable-cors
[link4]: https://developer.mozilla.org/en-US/docs/HTTP/Access_control_CORS
[link5]: https://developer.mozilla.org/
[link6]: https://developer.mozilla.org/en-US/docs/HTTP/Access_control_CORS#The_HTTP_response_headers
