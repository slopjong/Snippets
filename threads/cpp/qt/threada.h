#ifndef THREADA_H
#define THREADA_H

#include <QThread>

class ThreadA : public QThread
{
	Q_OBJECT
public:
	explicit ThreadA(QObject *parent = 0);
	
protected:
	void run();

signals:
	
public slots:
	
};

#endif // THREADA_H
