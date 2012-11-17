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

**Important**, you have to be in the ```video``` group in order to let mplayer open the ```/dev/video0``` device. Otherwise you have to run _camshot_ as root.