Site URL: www.studydigs.com

WARNING: The Aberystwyth University Network does not allow the htaccess files to run when the site is hosted on the network.

Details for installation

1. Create the database tables in a MySQL database using the SQL stored in the `studydigs_sql.sql` file.
2. Within the file app->config->config.php:
    2a. Change the database paramenters to your own database credientials.
    2b. Change the defined URL root to the URL that you are hosting the site on.
3. Within the file public->.htaccess:
    If hosting the site in the website root directory:
        3a. Set RewriteBase to /public
    else 
        3b. Set  RewriteBase to your file path with /public on the end, for example: /studydigs/public

Requirements:
The site uses the following libraries and frameworks:
1. PHPCodeSniffer
2. Bootstrap
3. SASS
4. JQuery (CDN Provided)
5. DataTables (CDN Provided)
6. Mapbox (CDN Provided)