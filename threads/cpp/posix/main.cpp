#include <stdio.h>
#include <iostream>
#include <pthread.h>

using namespace std;

void example1();
void example2();

int main()
{
	example1();
	//example2();
	return 0;
}

/**
 * Example 1
 */

void* threadA(void *ptr);
void* threadB(void *ptr);

void example1()
{
	pthread_t thread1, thread2;

	pthread_create(&thread1, NULL, & threadA, NULL);
	pthread_create(&thread2, NULL, & threadB, NULL);

	pthread_join(thread1, NULL);
	pthread_join(thread2, NULL);
}

void* threadA(void *ptr)
{
	for(int i=0; i<10; i++)
	{
		cout << "A" << endl;
		sleep(1);
	}
	return NULL;
}

void* threadB(void *ptr)
{
	for(int i=0; i<10; i++)
	{
		cout << "B" << endl;
		sleep(1);
	}
	return NULL;
}

/**
 * Example 2
 */

void * print_message_function( void *ptr );
void * main_thread ( void *ptr );

void example2()
{
	pthread_t thread1, thread2;
	int  iret1, iret2;

	iret1 = pthread_create (&thread1, NULL, & main_thread, NULL);

	pthread_join( thread1, NULL);
	printf("Thread 1 returns: %d\n",iret1);
}

void * main_thread ( void *ptr )
{
	cout << "main_thread" << endl;

	char *message1 = "Thread 1";
	char *message2 = "Thread 2";
	pthread_t thread3, thread4;
	int iret3, iret4;

	iret3 = pthread_create(&thread3, NULL, & print_message_function, (void *) message1);
	iret4 = pthread_create(&thread4, NULL, & print_message_function, (void *) message2);

	//pthread_join( thread3, NULL);
	//pthread_join( thread4, NULL);

	return NULL;
}

void * print_message_function( void *ptr )
{
	cout << "print_message_function" << endl;

	char *message;
	message = (char *) ptr;
	printf("%s \n", message);
	return NULL;
}



/*

The example on [0] leads to this error: invalid conversion from 'void (*)()' to 'void* (*)'

Some explanations on [1]

[0] http://www.risc.jku.at/people/schreine/papers/rt++-linuxmag1/main.html
[1] http://forums.devshed.com/c-programming-42/invalid-conversion-from-void-to-void-void-136565.html

*/
