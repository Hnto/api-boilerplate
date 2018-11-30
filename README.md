# Docker setup

Contains a small API boilerplate built with API platform and dockerized using docker compose version 3.

_**For the application setup see the README file in the app/ folder**_

#
# Installation with the install wizard:
- run the command "composer install"
- run the command "php api install" and follow the setup
- go the [HOST/api](HOST/api) to see the documentation of API platform. 

_**if you are running in production you must manually migrate the database (see step 3 --> dash 2 --> dash 1)**_

#
# Installation done manually:
### Step 1 (in root folder)
- change the ".env.example" file in the root to ".env"
- modify the DB_PASS and DB_ROOT_PASS into something secure

### Step 2 (in app/ folder)
- change the "app/.env.dist" file to "app/.env"
- modify the places where it says "#CHANGE"
    - APP_ENV (production | local | development)
    - APP_DEBUG (true | false)
    - APP_KEY (must be a 32 chars long random string)
    - DB_USERNAME (the username used in the .env of the container)
    - DB_PASSWORD (the password used in the .env of the container)
       
### Step 3 (in root folder)
- run the command `docker-compose up -d --build`
    - it can take up to 5 or 10 minutes
- run the command `docker exec -it api_workspace bash` to ssh into the workspace container
    - run the command `bin/console doctrine:database:create` to create the database
    - run the command `bin/console doctrine:migrations:migrate` to migrate the tables
        - If you go to 127.0.0.1:{PORT} -> login -> insert a new user with an api key
    
Your containers are now ready and the mysql database can be handled with adminer.
The application is available on the host `127.0.0.1:{PORT}` and adminer on `127.0.0.1:{PORT}`

#
# UPDATING Api:
- run the command "php api update"
    - the environment will be determined by the APP_ENV value in your "app/.env" file
        - for production updates, migrations must be done manually

# Facts
- The mysql data and configuration is saved in the `./mysql` folder
- The logs are saved in the `./logs` folder

# Common problems
- CSS not loading
    - Execute `docker exec api_workspace bin/console assets:install`
- Migrations could not be executed due to wrong database credentials
    - Execute "Step 1" steps in manual installation
    - Execute "Step 2" steps in manual installation
    - Execute `docker exec api_workspace bin/console --no-interaction doctrine:migrations:migrate`
- Generic error
    - Execute steps 1, 2 and 3
