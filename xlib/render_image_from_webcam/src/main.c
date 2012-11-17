/*
 * simple-drawing.c - demonstrate drawing of pixels, lines, arcs, etc.
 *                    on a window. All drawings are done in black color
 *                    over a white background.
 */

#include <X11/Xlib.h>

#include <stdio.h>
#include <stdint.h>
#include <stdlib.h>
#include <unistd.h>
#include <IL/ilu.h>

/*
 * function: create_simple_window. Creates a window with a white background
 *           in the given size.
 * input:    display, size of the window (in pixels), and location of the window
 *           (in pixels).
 * output:   the window's ID.
 * notes:    window is created with a black border, 2 pixels wide.
 *           the window is automatically mapped after its creation.
 */
Window create_simple_window(Display* display, int width, int height, int x,
		int y)
{
	int screen_num = DefaultScreen(display);
	int win_border_width = 2;
	Window win;

	/* create a simple window, as a direct child of the screen's */
	/* root window. Use the screen's black and white colors as   */
	/* the foreground and background colors of the window,       */
	/* respectively. Place the new window's top-left corner at   */
	/* the given 'x,y' coordinates.                              */
	win = XCreateSimpleWindow(display, RootWindow(display, screen_num) ,
	x, y, width, height, win_border_width,
	BlackPixel(display, screen_num),
	WhitePixel(display, screen_num));

	/* make the window actually appear on the screen. */
	XMapWindow(display, win);

	/* flush all pending requests to the X server. */
	XFlush(display);

	return win;
}

GC create_gc(Display* display, Window win, int reverse_video)
{
	GC gc; /* handle of newly created GC.  */
	unsigned long valuemask = 0; /* which values in 'values' to  */
	/* check when creating the GC.  */
	XGCValues values; /* initial values for the GC.   */
	unsigned int line_width = 2; /* line width for the GC.       */
	int line_style = LineSolid; /* style for lines drawing and  */
	int cap_style = CapButt; /* style of the line's edje and */
	int join_style = JoinBevel; /*  joined lines.		*/
	int screen_num = DefaultScreen(display);

	gc = XCreateGC(display, win, valuemask, &values);
	if (gc < 0)
	{
		fprintf(stderr, "XCreateGC: \n");
	}

	/* allocate foreground and background colors for this GC. */
	if (reverse_video)
	{
		XSetForeground(display, gc, WhitePixel(display, screen_num) );
		XSetBackground(display, gc, BlackPixel(display, screen_num));
	}
	else
	{
		XSetForeground(display, gc, BlackPixel(display, screen_num));
		XSetBackground(display, gc, WhitePixel(display, screen_num));
	}

		/* define the style of lines that will be drawn using this GC. */
	XSetLineAttributes(display, gc, line_width, line_style, cap_style,
			join_style);

	/* define the fill style for the GC. to be 'solid filling'. */
	XSetFillStyle(display, gc, FillSolid);

	return gc;
}

XImage * create_ximage(Display* display)
{
	XImage *ximage;

	ilInit();
	ILuint ImgId = 0;
	ilGenImages(1, &ImgId);
	ilBindImage(ImgId);
	ILboolean success = ilLoadImage("/tmp/slock/00000001.png");
	if (success)
	{
		fprintf(stdout, "Image loaded\n");

		ILint image_width = ilGetInteger(IL_IMAGE_WIDTH);
		ILint image_height = ilGetInteger(IL_IMAGE_HEIGHT);

		fprintf(stdout, "Width:%d\n", image_width);
		fprintf(stdout, "Height:%d\n", image_height);

		uint32_t background_pixels[image_width * image_height];

		int i = 0;
		for (; i < (image_width * image_height); i++)
			background_pixels[i] = 0;

		ilCopyPixels(0, 0, 0, image_width, image_height, 1, IL_BGRA,
				IL_UNSIGNED_BYTE, &background_pixels);

		ximage = XCreateImage(display,
				XDefaultVisual(display, XDefaultScreen(display)),
				XDefaultDepth(display, XDefaultScreen(display)), ZPixmap, 0,
				background_pixels, image_width, image_height, 32, 0);

	}
	else
	{
		fprintf(stdout, "Image not loaded\n");
		exit(1);
	}

	ilBindImage(0);
	ilDeleteImages(1, &ImgId);

	return ximage;
}

void main(int argc, char* argv[])
{
	// take a screenshot from the webcam saved as /tmp/slock/00000001.png
	system("mkdir -p /tmp/slock; /usr/bin/env mplayer -really-quiet -vo png:outdir=/tmp/slock -frames 1 tv://");

	Display* display;
	int screen_num;
	Window win;

	unsigned int width = 640;
	unsigned int height = 480;

	GC gc;

	display = XOpenDisplay(getenv("DISPLAY"));
	if (display == NULL )
	{
		fprintf(stderr, "%s: cannot connect to X server '%s'\n", argv[0],
				getenv("DISPLAY"));
		exit(1);
	}

	screen_num = DefaultScreen(display);

	/* create a simple window, as a direct child of the screen's   */
	/* root window. Use the screen's white color as the background */
	/* color of the window. Place the new window's top-left corner */
	/* at the given 'x,y' coordinates.                             */
	win = create_simple_window(display, width, height, 0, 0);

	/* allocate a new GC (graphics context) for drawing in the window. */
	gc = create_gc(display, win, 0);
	XSync(display, False);


	XImage *background = create_ximage(display);
	XPutImage(display, win, gc, background, 0, 0, 0, 0, 640, 480);

	/* flush all pending requests to the X server. */
	XFlush(display);
	XSync(display, False);

	/* make a delay for a short period. */
	sleep(4);

	/* close the connection to the X server. */
	XCloseDisplay(display);
}
