XLIB Example - Render screenshot from a webcam
===============================

To keep it short, execute this:

```
./autogen conf
make
./camshot
```

If you have a buggy X server installed no picture from the webcam is displayed but you'll see a white window instead.

A dirty but working workaround is to execute it with ```ltrace```:

```
ltrace -e donttraceanycalls ./camshot
```

```donttraceanycalls``` doesn't mean anything. It's just used as a filter to reduce the ltrace output which would write all the library calls to the standard output otherwise.

If the output looks like 

```
mplayer: could not connect to socket
mplayer: No such file or directory
--- SIGCHLD (Child exited) ---
Image loaded
Width:640
Height:480
+++ exited (status 0) +++
```
then try to run it as root. ```mplayer``` should be found then. 