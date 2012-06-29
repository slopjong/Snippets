#include <QtCore/QCoreApplication>
#include <QtCore/QFile>
#include <QtCore/QTextStream>

int main(int argc, char *argv[])
{
	QCoreApplication a(argc, argv);
	QTextStream cout(stdout, QIODevice::WriteOnly);

	QFile file("sample.txt");
	if(!file.open(QIODevice::WriteOnly | QIODevice::Text))
	{
		cout << "Could not open the file in write mode." << endl;
		return 1;
	}

	QTextStream fout(&file);
	fout << "If you can read this text it was obviously written to the file.\nNow you're reading the second line." << endl;
	file.close();

	cout << "Have a look at the sample.txt file." << endl;

	return 0;
}
