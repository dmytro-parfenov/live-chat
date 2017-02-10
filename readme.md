**Live chat**

`Project structure`

    app/                    models,controllers, requests, etc.
    config
        app.php             connecting providers, aliases
    db_copy/                actual copy of database
    public
        bower_components/   bower components
        frontend/           compiled scripts, compiled styles, fonts, images, sounds for frontend
        bower.json          list of bower components
        .htaccess           htaccess setings
        robots.txt          robots config
    resources
        assets/sass         frontend styles (.scss)
        assets/js           frontend scripts (.js)
        views               views of project
    vendor/                 composser packages
    .env                    connect to database etc.
    .composer.json          list of composser packages
    .gulpfile.js            gulp tasks
    .package.json           list of npm packages
    
`Launch project`

`You must execute command "npm install" for download package.json dependencies. Next open gulpfile.js and write a name of your domain in field "proxy". Exucute command "gulp start" to start.`

`Notes:`

`1. Edit styles only in directory "resources/assets/sass"`

`2. Edit scripts only in directory "resources/assets/js"`