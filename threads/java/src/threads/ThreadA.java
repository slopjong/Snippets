package threads;

public class ThreadA extends Thread {
	
	@Override
	public void run() 
	{		
		for(int i=0; i<10; i++)
		{
			try {
				sleep(500);
		    }
		    catch(InterruptedException e) 
		    {
		    }
			 
			System.out.println("A");
			
		}
	}
}
