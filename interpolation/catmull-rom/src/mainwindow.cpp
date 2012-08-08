#include "src/mainwindow.h"
#include "ui_mainwindow.h"

#include <QtCore/QFile>
#include <QtCore/QTextStream>

#include <QtGui/QPlainTextEdit>
#include <QtGui/QTextBlock>
#include <QtGui/QTextDocument>

#include <math.h>
#include <algorithm>

#include <QDebug>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);
    connect(ui->interpolateButton, SIGNAL(clicked()),
            SLOT(interpolateButtonClicked()));
}

MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::interpolateButtonClicked()
{
    QString tString = ui->tLineEdit->text();
    bool ok;
    double tValue = tString.toDouble(&ok);

    if(!ok)
        ; // if you're too stupid to enter a valid number, you're too stupid
    // to read a proper error message, so no error message here.


    // get the input by filtering non-valid input data
    QTextDocument *doc = ui->dataInput->document();
    QStringList inputList;
    for (QTextBlock it = doc->begin(); it != doc->end(); it = it.next())
    {
        QString line = QString::fromStdString(it.text().toStdString());
        // empty lines and malformed input are skipped
        if(line != ""
            && line.contains(QRegExp("-?\\d+(\\.\\d+)?\\s+-?\\d+(\\.\\d+)?")))
            inputList << line.trimmed();
        else
            qDebug() << "Skipping line: " << line;
    }

    int number_points = inputList.size();
    double data[number_points][2];

    // split the lines in x and y
    for(int i=0; i<inputList.size(); i++)
    {
        QString point = inputList.at(i);
        QStringList l = point.split(QRegExp("\\s+"));

        // this should never happen
        if(l.size()<2){
            qDebug() << "String couldn't be split.";
            qDebug() << "Can't interpolate.";
            return;
        }

        data[i][0] = l.at(0).toDouble();
        data[i][1] = l.at(1).toDouble();
    }

    // the output file
    QFile output;
    output.setFileName("results.dat");
    output.open(QIODevice::WriteOnly | QIODevice::Text);
    QTextStream fout(&output);

    // basic matrix
    double Mcr[4][4] = {
        {-0.5, 1.5, -1.5, 0.5},
        {1, -2.5, 2, -0.5},
        {-0.5, 0, 0.5, 0},
        {0, 1, 0, 0}
    };

    double Gbi[4][2];

    for(int i=0; i<number_points-1; i++)
    {
        // Select the four points required for the calculation.
        // With the min/max functions the border points are implicitely
        // duplicated as they wouldn't be interpolated by the algorithm
        // otherwise.
        for(int j=0; j<2; j++)
        {
            Gbi[0][j] = data[std::max(0, i-1)][j];
            Gbi[1][j] = data[i][j];
            Gbi[2][j] = data[std::min(number_points-1, i+1)][j];
            Gbi[3][j] = data[std::min(number_points-1, i+2)][j];
        }

        // interpolate points between two given points
        for(double u=0; u<1; u=u+0.001)
        {
            double T[4] = {pow(u,3), pow(u,2), u, 1};
            double results[2] = {0, 0};

            // interpolate one point by calculating T * Mcr * Gbi
            for(int bi_ctr=0; bi_ctr<2; bi_ctr++)
            {
                double sum = 0;
                for(int point_row=0; point_row<4; point_row++)
                {
                    for(int mcr_row=0; mcr_row<4; mcr_row++)
                    {
                        sum += T[mcr_row] * Mcr[mcr_row][point_row]
                                * Gbi[point_row][bi_ctr];
                    }
                }
                results[bi_ctr] = sum;
            }

            fout << results[0] << " " << results[1] << "\n";

            // if the user entered a valid value for x then display y
            if(ok)
            {
                //qDebug() << "ok";

                double diff = results[0] - tValue;
                //qDebug() << tValue << " " << results[0];
                qDebug() << diff;

                if( diff <= 0.001 )
                    ui->resultLineEdit->setText(QString("%1").arg(results[1]));
            }
        }
    }

    output.close();
}
