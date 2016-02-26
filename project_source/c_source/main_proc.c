#include <stdio.h>
#include <mysql.h>
#include <unistd.h>
#include <stdlib.h>

void error(char *);
void program();
void init();
void get_place();
double string_to_double(char *);
void process();
void upload();

//bool running;
MYSQL *connection;
double people_db[200][5],bicycle_db[200][5],best_place[200][5];

int main()
{
	//printf("%s\n",mysql_get_client_info());
	connection = mysql_init(NULL);
	if(connection == NULL)
	{
		error("connection error");
	}

	if(mysql_real_connect(connection,"stories2.iptime.org","stories2","toortoor%^%","stories2",3306,0,0) == NULL)
	{
		error("db server connect fail");
	}
	else
	{
//		running = true;
		printf("connected\n");
	}
	program();
	mysql_close(connection);
	mysql_library_end();
	printf("program end\n");
	return 0;
}

void program()
{
	while(1)
	{
		init();
		get_place();
		process();
		upload();
		sleep(60);
		//break;
	}
}

void upload()
{
	char query[1000] = {'\0',};
	int i;
	for(i=1;i<=best_place[0][0];i+=1)
	{
		sprintf(query,"insert into best_place (people_num,latitude,longitude,shows) value(%f,%f,%f,0);",best_place[i][0],best_place[i][1],best_place[i][2]);
		if(mysql_query(connection,query) != 0)
		{
			error(query);
		}
		else
		{
			printf("%s ok\n",query);
		}
	}
}

void process()
{
	int i,t;
	printf("process start\n");
	for(i=1;i<people_db[0][0];i+=1)
	{
		for(t=0;t<=2;t+=1)
		{
			best_place[i][t] = (people_db[i][t] + people_db[i+1][t])/2;
		}
	}
	best_place[0][0] = i-1;
	printf("process end\n");
}

void get_place()
{
	MYSQL_ROW row;
	MYSQL_RES *result_set;
	int i,cnt = 0;

	char *query = NULL;
	query = "select people_num,latitude,longitude from people order by people_num desc;";
	if(mysql_query(connection,query) != 0)
	{
		error(query);
	}
	else
	{
		printf("%s ok\n",query);
	}
	result_set = mysql_store_result(connection);
	while((row = mysql_fetch_row(result_set)) != NULL)
	{
		cnt+=1;
		//printf("%s %s %s\n",row[0],row[1],row[2]);
		for(i=0;i<=2;i+=1)
		{
			people_db[cnt][i] = string_to_double(row[i]);
//			printf("%f ",people_db[cnt][i]);
		}
		//printf("\n");
	}
	people_db[0][0] = cnt;
	mysql_free_result(result_set);

	query = "select latitude,longitude from bicycle_station;";
	if(mysql_query(connection,query) != 0)
	{
		error(query);
	}
	else
	{
		printf("%s ok\n",query);
	}
	result_set = mysql_store_result(connection);
	cnt = 0;
	while((row = mysql_fetch_row(result_set))!=NULL)
	{
		cnt += 1;
		for(i=0;i<=1;i+=1)
		{
			bicycle_db[cnt][i] = string_to_double(row[i]);
		}
	}
	bicycle_db[0][0] = cnt;
	mysql_free_result(result_set);
}

double string_to_double( char *target)
{
	
	return atof(target);
}

void init()
{
	char *query = NULL;
	query = "delete from best_place;";
	if(mysql_query(connection,query) != 0)
	{
		error(query);
	}
	else
	{
		printf("%s ok\n",query);
	}
}

void error(char *err_str)
{
	printf("Error %s\n",err_str);
	return;
//	exit(1);
}
