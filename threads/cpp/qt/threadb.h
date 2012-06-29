#ifndef THREADB_H
#define THREADB_H

#include <QThread>

class ThreadB : public QThread
{
	Q_OBJECT
public:
	explicit ThreadB(QObject *parent = 0);
	
protected:
	void run();

signals:
	
public slots:
	
};

#endif // THREADB_H
