#include <QApplication>
#include "mainwindow.h"
#include <math.h>
#include <algorithm>
#include <QDebug>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    //MainWindow w;
    //w.show();

    // TODO: read the data from a file or from the GUI
    double data[4][2] = {
      {0, 3},
      {10, 1},
      {12, -5},
      {13, 6}
    };

    // Catmull-Rom algorithm

    // basic matrix
    double Mcr[4][4] = {
        {-0.5, 1.5, -1.5, 0.5},
        {1, -2.5, 2, -0.5},
        {-0.5, 0, 0.5, 0},
        {0, 1, 0, 0}
    };

    int number_points = sizeof(data) / sizeof( data[0] );

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

            //qDebug() << results[0] << results[1];
            // TODO: write the interpolated points to a file
        }
    }

    exit(0);
    return a.exec();
}
