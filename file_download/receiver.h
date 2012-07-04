#ifndef RECEIVER_H
#define RECEIVER_H

#include <QObject>

#include <QtCore/QTextStream>

#include <QtNetwork/QNetworkReply>
#include <QtNetwork/QNetworkRequest>
#include <QtNetwork/QSslError>

class Receiver : public QObject
{
    Q_OBJECT

public:

    explicit Receiver( QNetworkReply *reply, QObject *parent = 0);

public slots:

    void slotReadyRead();
    void slotError(QNetworkReply::NetworkError);
    void slotSslErrors(QList<QSslError>);
    void slotFinished();
    void slotBytesWritten(qint64);

private:

    QTextStream cout;
    QNetworkReply * m_reply;

    void printContent();

};

#endif // RECEIVER_H
