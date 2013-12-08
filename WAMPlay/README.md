WAMPlay Publish & Subscribe Sample
==================================

Usage
-----

Execute `./run`.


About
-----

This example shows how to use the WAMP Play module. It has two ways to register topics on the server: addTpoic() and by extending WAMPlayController.


Troubleshooting
-----

If you get an error message such as `java.util.NoSuchElementException: key not found: SOURCE` then execute

```
./activator clean update
```

and run play again with `./run`.


Test the Websocket handshake
----

To test the handshake you can use `cURL` as follows:

```
curl -i -N -H "Connection: Upgrade" -H "Upgrade: websocket" -H "Host: localhost:8888" -H "Origin:http://localhost:8888" http://localhost:8888/pubsub
```

You should see the following output:

```
HTTP/1.1 101 Web Socket Protocol Handshake
Upgrade: WebSocket
Connection: Upgrade
WebSocket-Origin: http://localhost:8888
WebSocket-Location: ws://localhost:8888/pubsub

[0,"3e142111-875a-4705-bddb-c3a1cf18f839",1,"WAMPlay/0.1.6"]
```