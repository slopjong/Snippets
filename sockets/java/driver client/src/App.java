import java.io.*;
import java.net.*;

public class App 
{
    public static void main(String[] args) throws IOException 
    {
        String hostName = "localhost";
        int portNumber = 9999;

        try
        (
            Socket socket = new Socket(hostName, portNumber);
            PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
            BufferedReader in = new BufferedReader(
                new InputStreamReader(socket.getInputStream()));
        ) 
        {	
            String fromServer;
            
            // we run the loop only 3 times to simulate an app unsubscribing
            // on the 'stop' event by a user, though there's no real user
            // involved in this use case.
            for(int i=0; i<3; i++)
            {
            	System.out.println("Client loop #" + i);
	            while ((fromServer = in.readLine()) != null)
	            {
	                System.out.println("Server: " + fromServer);
	                    break;
	            }
            }
            
            out.println("unsubscribe");
            socket.close();
        } 
        catch (UnknownHostException e) 
        {
            System.err.println("Don't know about host " + hostName);
            System.exit(1);
        } 
        catch (IOException e) 
        {
            System.err.println("Couldn't get I/O for the connection to " + hostName);
            System.exit(1);
        }
    }
}
