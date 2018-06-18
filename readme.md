# CMS for Fundación de Museos Nacionales (FMN) de Venezuela 
This web application is an administration panel made with Codeigniter, a PHP framework, for the FMN website.

This app allows you to create, modify and delete different elements within the website such as news, exhibitions, collections and so on. It also allows managing users within the app. It has its own custom slugs creation system for each content created inside it.

The goal was to join the FMN web site with the websites of the others museums in Venezuela.  Previously the web sites were made with Drupal (a CMS) and used the data of two different databases, so my task was to use the existing databases and create one more manageable for this new application. Therefore, I created an ETL (using Kettle Pentaho) to get the relevant data for about 400 tables.

Over that new database was created this web app.