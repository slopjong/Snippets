#include "receiver.h"

Receiver::Receiver(QNetworkReply *reply, QObject *parent) :
    QObject(parent),
    cout(stdout, QIODevice::WriteOnly),
    m_reply(reply)
{

}

void Receiver::slotReadyRead()
{
    cout << "slotReadyRead()" << endl;
}

void Receiver::slotError(QNetworkReply::NetworkError)
{
    cout << "slotError()" << endl;
    exit(1);
}

void Receiver::slotSslErrors(QList<QSslError>)
{
    cout << "slotSslErrors()" << endl;
    exit(1);
}

void Receiver::slotFinished()
{
    cout << "slotFinished()" << endl;
    this->printContent();
    exit(0);
}

void Receiver::slotBytesWritten(qint64)
{
    cout << "slotBytesWritten()" << endl;
}

void Receiver::printContent()
{
    cout << "printContent()" << endl;

    QByteArray content = m_reply->readAll();
    cout << content << endl;
}
