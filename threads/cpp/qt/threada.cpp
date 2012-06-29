#include "threada.h"
#include <QDebug>

ThreadA::ThreadA(QObject *parent) :
	QThread(parent)
{

}

void ThreadA::run()
{
	for(int i=0; i<10; i++)
	{
		qDebug("A");
		sleep(1);
	}
}
