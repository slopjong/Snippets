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