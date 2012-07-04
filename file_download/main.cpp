#include <QCoreApplication>
#include <QObject>

#include <QtCore/QByteArray>
#include <QtCore/QBuffer>
#include <QtCore/QFile>
#include <QtCore/QList>
#include <QtCore/QStringList>
#include <QtCore/QTextStream>
#include <QtCore/QUrl>

#include <QtNetwork/QNetworkAccessManager>
#include <QtNetwork/QNetworkReply>
#include <QtNetwork/QNetworkRequest>
#include <QtNetwork/QSslError>

#include "receiver.h"

int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);

    QNetworkAccessManager network;
    QNetworkRequest request(QUrl("http://slopjong.de"));
    QNetworkReply *reply = network.get(request);

    Receiver receiver(reply);

    receiver.connect(reply, SIGNAL(readyRead()), SLOT(slotReadyRead()));
    receiver.connect(reply, SIGNAL(error(QNetworkReply::NetworkError)), SLOT(slotError(QNetworkReply::NetworkError)));
    receiver.connect(reply, SIGNAL(sslErrors(QList<QSslError>)), SLOT(slotSslErrors(QList<QSslError>)));
    receiver.connect(reply, SIGNAL(finished()), SLOT(slotFinished()));
    receiver.connect(reply, SIGNAL(bytesWritten(qint64)), SLOT(slotBytesWritten(qint64)));

    return a.exec();
}
