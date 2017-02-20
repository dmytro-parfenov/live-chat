**Live chat**

`Project structure`

    app/                    models,controllers, requests, etc.
    config
        app.php             connecting providers, aliases and other settings of app
    db_copy/                actual copy structure of database
    public
        bower_components/   bower components
        admin/              compiled scripts, compiled styles for admin
        frontend/           compiled scripts, compiled styles, fonts, images, sounds for frontend
        bower.json          list of bower components
        .htaccess           htaccess setings
        robots.txt          robots config
    resources
        assets
            admin/          admin styles (.scss) and scripts (.js)
            frontend/       frontend styles (.scss) and scripts (.js)
        views               views of project
    vendor/                 composser packages
    .env                    connect to database etc.
    .composer.json          list of composser packages
    .gulpfile.js            gulp tasks
    .package.json           list of npm packages
    
`Launch project`

`You must execute commands "npm install" and "composer install" for download package.json and composer.json dependencies. Next open gulpfile.js and write a name of your domain in field "proxy". Exucute command "gulp start" to start.`

`Notes:`

`1. Edit scripts and styles only in directory "resources/assets/"`