#include "threadb.h"
#include <QDebug>

ThreadB::ThreadB(QObject *parent) :
	QThread(parent)
{
}

void ThreadB::run()
{
	for(int i=0; i<10; i++)
	{
		qDebug("B");
		sleep(1);
	}
}
