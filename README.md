download project 

run this code: php artisan db:create 127.0.0.1 3306 username password db        // in this example database name is db
run this code: php artisan migrate  

in postman :

post to create new database and save info in db : 
	- http://localhost:8000/db/ 

	- in body request with bulk edit paste those:
		name:databasename
		companyID:id
		host:127.0.0.1
		port:3306
		passowrd:
		username:root

put to edit companyID in db : 
	- http://localhost:8000/db/id 

	- in body request add as below :
		companyID:id
		
get to select one database info from db : 
	- http://localhost:8000/db/id 

get to select all databases info from db : 
	- http://localhost:8000/db/

delete to remove added database and remove info from db : 
	- http://localhost:8000/db/id

	- in body request with bulk edit paste those:
		host:127.0.0.1
		port:3306
		passowrd:
		username:root


that is all ^_^
