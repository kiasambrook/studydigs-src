# Studydigs

Site URL: www.studydigs.com

This project has been developed for CS39930 - Web Based Major Project which is a final module in my BSc Business Information Technology degree.

Study Digs is a website for students to search through available student rental houses in their area that have been uploaded by estate agents and landlords. It will be a streamlined way for students to see all the information they need about the properties including facilities, location, price, and whether bills are included.

## Details for installation
1. Create the database tables in a MySQL database using the SQL stored in the `studydigs_sql.sql` file.
2. Within the file app->config->config.php:
    2a. Change the database paramenters to your own database credientials.
    2b. Change the defined URL root to the URL that you are hosting the site on.
3. Within the file public->.htaccess:
    If hosting the site in the website root directory:
        3a. Set RewriteBase to /public
    else 
        3b. Set  RewriteBase to your file path with /public on the end, for example: /studydigs/public

## Requirements:
The site uses the following libraries and frameworks:
1. PHPCodeSniffer
2. Bootstrap
3. SASS
4. JQuery (CDN Provided)
5. DataTables (CDN Provided)
6. Mapbox (CDN Provided)
