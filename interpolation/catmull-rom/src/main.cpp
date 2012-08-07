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

    double MCR[4][4] = {
        {-0.5, 1.5, -1.5, 0.5},
        {1, -2.5, 2, -0.5},
        {-0.5, 0, 0.5, 0},
        {0, 1, 0, 0}
    };

    int number_points = sizeof(data) / sizeof( data[0] );

    double points[4][2];

    for(int i=0; i<number_points-1; i++)
    {
        for(int j=0; j<2; j++)
        {
            points[0][j] = data[std::max(0, i-1)][j];
            points[1][j] = data[i][j];
            points[2][j] = data[std::min(number_points-1, i+1)][j];
            points[3][j] = data[std::min(number_points-1, i+2)][j];
        }

        for(double u=0; u<1; u=u+0.001)
        {
            double uVector[4] = {pow(u,3), pow(u,2), u, 1};
            double results[2] = {0, 0};

            for(int coordinate=0; coordinate<2; coordinate++)
            {
                for(int point=0; point<4; point++)
                {
                    for(int MCRrow=0; MCRrow<4; MCRrow++)
                    {
                        double sum = results[coordinate];
                        results[coordinate] = sum + uVector[MCRrow]
                                * MCR[MCRrow][point] * points[point][coordinate];
                    }
                }
            }

            // TODO: write the interpolated points to a file
        }
    }

    exit(0);
    return a.exec();
}
