#include "SimpleIni.h"
#include <iostream>
#include <stdlib.h>

using namespace std;

/**
 * Uses the simpleini library.
 *
 * See http://code.jellycan.com/simpleini/
 */
int main(int argc, char** argv)
{
	CSimpleIniA ini;
	ini.SetUnicode();

	if( SI_OK == ini.LoadFile("../../gs-00.ini"))
	{
		// get the value from the ini file
		const char *app_loss = ini.GetValue("ApplicationRequirements", "LossRate", "0.01");

		// convert it to a double
		double d_app_loss = atof(app_loss);

		// output
		cout <<  "ApplicationRequirements/LossRate: " << d_app_loss << endl;

		/******************************************************************************/

		// get the value from the ini file
		const char *net_loss = ini.GetValue("NetworkOffers", "LossRate", "0.01");

		// convert it to a double
		double d_net_loss = atof(net_loss);

		// output
		cout <<  "NetworkOffers/LossRate: " << d_net_loss << endl;

	}
	else
		cout << "Le fichier gimmemore.ini n'existe pas. Désolé.";

	return 0;
}
