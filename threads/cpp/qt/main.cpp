#include <QtCore/QCoreApplication>
#include "threada.h"
#include "threadb.h"

int main(int argc, char *argv[])
{
	QCoreApplication a(argc, argv);
	
	ThreadA threada;
	ThreadB threadb;

	threada.start();
	threadb.start();

	return a.exec();
}
