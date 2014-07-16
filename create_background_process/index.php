<?php

// The browser will hang if we call the program directly, this means
// that the script will wait until the program is closed
#exec("/usr/bin/scite");
#exec("/usr/bin/scite &");
#system("/usr/bin/scite");
#system("/usr/bin/scite &");

// with the following line the script won't block. The echo will be
// executed right after this line but the browser seems to wait for
// something, it indicates that it's still loading. As soon as the
// program is closed the script finally exits and the browser won't
// wait for more
#exec("/usr/bin/scite > /dev/null &");
#system("/usr/bin/scite > /dev/null &");

// Both lines seem to work well. Though also here the browser seems
// to wait for something. Both lines work similar but system
// exec() doesn't print the output of 'echo $!' while system() does
#exec("nohup /usr/bin/scite > /dev/null 2>&1 & echo $!");
#system("nohup /usr/bin/scite > /dev/null 2>&1 & echo $!");

// We can get the process ID with both lines but system() is not recommended
// since 'echo $!' will print the PID directly to the output buffer but
// we need that echo command, otherwise we couldn't initialize $pid
#$pid = exec("nohup /usr/bin/scite > /dev/null 2>&1 & echo $!");
#$pid = system("nohup /usr/bin/scite > /dev/null 2>&1 & echo $!");

$pid = exec("nohup /usr/bin/scite > /dev/null 2>&1 & echo $!");
echo "The procoess ID is $pid";

// We could easily terminate the program as with this line
#system("kill -15 $pid");