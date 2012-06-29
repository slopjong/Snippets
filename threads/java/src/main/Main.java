package main;

import threads.ThreadA;
import threads.ThreadB;

public class Main {

	public static void main(String[] args) {

		System.out.println("Execute Thread A");
		
		ThreadA a = new ThreadA();
		a.start();
		
		ThreadB b = new ThreadB();
		b.start();

	}

}
