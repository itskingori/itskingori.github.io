---
title: Do we need to call HttpURLConnection.disconnect()?
category: minutae
layout: post
---

Well, it kinda depends but usually ...

**no.**

As per [javadoc](http://docs.oracle.com/javase/7/docs/api/java/net/HttpURLConnection.html);

> Each HttpURLConnection instance is used to make a single request but the
> underlying network connection to the HTTP server may be transparently shared
> by other instances. Calling the `close()` methods on the InputStream or
> OutputStream of an HttpURLConnection after a request may free network
> resources associated with this instance but _has no effect on any shared
> persistent connection_. Calling the `disconnect()` method _may close the
> underlying socket_ if a persistent connection is otherwise idle at that time.

In simpler terms ...

> I don't say it is a mistake. But, disconnect is extreme case (socket close
> open operations are costly), unless you really want I wouldn't go for it.
> `stream.close()` releases most of the network resources and should be enough.
> Again, if your requirement is ok to create socket everytime, there is nothing
> wrong in calling disconnect.

> ~ [Nambari](http://stackoverflow.com/questions/11056088/do-i-need-to-call-httpurlconnection-disconnect-after-finish-using-it#comment14465352_11056207)

Example;

```java
//Initialize variables
InputStream responseInputStream = null;
HttpURLConnection conn = null;
int responseCode = -1;

try {
  // Create a connection
  URL url = new URL(targetURL);
  conn = (HttpURLConnection) url.openConnection();

  // SET FANCY DETAILS HERE

  // Starts the connection
  conn.connect();

  // Get the response code
  responseCode = conn.getResponseCode();

  // Check the response code, if the HTTP response code is 4nn
  // (Client Error) or 5nn (Server Error), then you may want to
  // read the HttpURLConnection#getErrorStream() to see if the
  // server has sent any useful error information.
  if (responseCode < 400) {
    // Get the response InputStream if all is well
    responseInputStream = conn.getInputStream();
  }
  else if (responseCode >= 400) {
    // Get the response ErrorStream if we got an error instead
    responseInputStream = conn.getErrorStream();
  }
}

catch (IOException e) {
  // YOU CAN DO WHATEVER HERE
  e.printStackTrace();
}

finally {
  // Makes sure that the InputStream is closed after
  // we are done with it
  if (responseInputStream != null) {
    try {
      responseInputStream.close();
    }

    catch (IOException e) {
      // YOU CAN DO WHATEVER HERE
      e.printStackTrace();
    }
  }
}
```

That should do.

---

1. [Do I need to call HttpURLConnection.disconnect after finish using it?](http://stackoverflow.com/questions/11056088/do-i-need-to-call-httpurlconnection-disconnect-after-finish-using-it)
2. [Java Class HttpURLConnection](http://docs.oracle.com/javase/7/docs/api/java/net/HttpURLConnection.html)
3. [Android Training: Connecting & download from the network](http://developer.android.com/training/basics/network-ops/connecting.html#download)
