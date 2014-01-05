 
import java.net.*;
import java.util.ArrayList;
import java.io.*;
 
public class Driver 
{
	private static boolean running = true;
	private static ArrayList<Socket> connections = new ArrayList<Socket>();
	private static ServerSocket serverSocket;
	
    public static void main(String[] args) throws IOException, InterruptedException 
    {
        int portNumber = 9999;
        serverSocket = new ServerSocket(portNumber);
        collectConnections();
        
        while(running)
        {
        	int data = sense();
        	pushData(data);
        	Thread.sleep(100);
        }
        
        serverSocket.close();
    }
    
    private static void pushData(int data)
    {
		try 
		{
			System.out.println("#conns: " + connections.size());
			for(Socket connection : connections)
			{
				if(connection.isClosed())
				{
					System.out.println("Connection closed");
				}
				else
				{
					if(connection.getInputStream().available() == 0)
					{
						PrintWriter out = new PrintWriter(connection.getOutputStream(), true);
						out.println(data);
						// if we close here the printwriter we close the connection
						//out.close();
					}
					else
					{
						BufferedReader input = new BufferedReader(new InputStreamReader(connection.getInputStream()));
						String fromClient;
						while((fromClient = input.readLine()) != null)
						{
							if(fromClient.equalsIgnoreCase("unsubscribe"))
							{
								connections.remove(connection);
								connection.close();
								System.out.println("Unsubscribe client");
							}
						}
					}
				}
			}
		} 
		catch(SocketException e)
		{
			
		}
		catch (IOException e) 
		{
			e.printStackTrace();
			running = false;
		}
		catch (Exception e)
		{
			running = false;
		}
    }
    
    private static int sense()
    {
    	return 1;
    }
    
    private static void collectConnections()
    {	
		(new Thread(){

			@Override
			public void run()
			{	
				while(running)
				{
					try 
					{
						Socket clientSocket = serverSocket.accept();
						System.out.println("Client subscribed");
						connections.add(clientSocket);
					}
					catch(SocketException e)
					{
						
					}
					catch(IOException e) 
					{
						e.printStackTrace();
						running = false;
					}
					catch(Exception e)
					{
						System.out.println("Shutdown the driver");
						running = false;
					}
				}
			}

		}).start();
    }
}
