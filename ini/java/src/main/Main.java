package main;

import org.ini4j.*;
import java.io.*;

/**
 * This example reads a ini file and writes them to the standard output.
 */
public class Main {

	public static void main(String[] args) {

	  try{
	    String filename = "../../gs-00.ini";
	    Ini i = new Ini(new File(filename));
	    double loss = i.get("ApplicationRequirements", "LossRate", double.class);
	    System.out.println("ApplicationRequirements/LossRate: " + loss);
	    double fs = i.get("NetworkOffers", "FrameSize", double.class);
	    System.out.println("NetworkOffers/Framesize: " + fs);
	  }
	  catch(Exception e)
	  {
	  }
	}

}
