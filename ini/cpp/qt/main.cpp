#include <QtCore/QCoreApplication>
#include <QtCore/QSettings>
#include <QTextStream>

int main(int argc, char *argv[])
{
	QCoreApplication a(argc, argv);
	QTextStream cout(stdout, QIODevice::WriteOnly);
	QSettings ini("../../gs-00.ini", QSettings::NativeFormat);

	if(QSettings::NoError == ini.status())
	{
		ini.beginGroup("ApplicationRequirements");
		QString app_framesize = ini.value("FrameSize").toString();
		double d_app_framesize = app_framesize.toDouble();
		cout << "ApplicationRequirements/FrameSize: " << d_app_framesize << endl;
		ini.endGroup();

		ini.beginGroup("NetworkOffers");
		QString net_framesize = ini.value("FrameSize").toString();
		double d_net_framesize = net_framesize.toDouble();
		cout << "NetworkOffers/FrameSize: " << d_net_framesize << endl;
		ini.endGroup();
	}

	return a.exec();
}
