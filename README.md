# URL-Link-Shortener
A build-your-own URL shortener for a domain.

# Requirements
1. Web Hosting Service
2. Domain to use as link address
3. A MySQL database

# Instructions
1. Create a MySQL Database called what you want. I.E. URLShortener
2. Create a login that has select, insert, update and delete access to said database
3. Create a table in the database called links
4. Create 3 columns in the table:  
  a. linkID int(6) primary AutoIncrement,  
  b. linkCode varchar(10),  
  c. linkDestination varchar(200)  
![alt text](https://github.com/TheMaster870/URL-Link-Shortener/blob/main/images/sqlcolumns.PNG?raw=true)
  
5. Create a table called password with one columns called password as varchar(20)
6. Insert one entry into that table with the password you would like to set
7. Copy the files in the URLShortener folder into the root of your domain
8. Edit the connect.php, edit.php and index.php files personalising them with your details, See comments in files.
9. Create a file called .htaccess with the following code (This removes the need for ?c= after the domain):  
  **RewriteEngine On  
  RewriteCond %{REQUEST_FILENAME} !-f  
  RewriteCond %{REQUEST_FILENAME} !-d  
  RewriteRule ^(.*)$ index.php?c=$1 [QSA,L]**
11. Visit YourDomain/codes.php to login and create a url link
12. Goto YourDomain/aCode to get redirected to the set URL
