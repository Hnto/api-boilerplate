# API boilerplate

This application is a small API boilerplate built with API platform. For further
information regarding setup, endpoints, authentication etc. please see down below.

## Installing
run the command `composer install`

## Setup mock API
- copy the `.env.dist` file to `.env`
    - edit the database info: `DATABASE_URL`
- run the command `bin/console doctrine:database:create`
- run the command `bin/console doctrine:migrations:migrate`
- run the command `bin/console server:start`

**The migrations have executed and the server has been started at `http://localhost:8000`.**
**Your API can be found at `/api/`. Every endpoint comes after the `/api/` prefix.**

## API Endpoints
For API endpoints to be read and be available by the framework, you must execute the following steps:
- Create an entity by running the command `bin/console make:entity` and follow the steps
    - If you'd like your endpoint to have the standard CRUD operations and nothing more, choose `yes` when asked if this entity must be a API-platforn response
- Create the platform yaml file in `config/api_platform/ENTITY_NAME.yaml`
    - See the example `page.yaml` for standard CRUD operations
    - See the example `website.yaml` for standard CRUD operations in combination with your own methods
- Add the location of the yaml in `config/packages/api_platform.yaml` in the mapping/paths key 
- If needed, create a controller by running the command `bin/console make:controller`

## Authentication
Authentication is provided by default with an api-key and token verification.
- The firewall settings can be found in `config/packages/security.yaml`
- The guards can be found in `src/Security/`
  - There is an ApiKey and Token authenticator
  - Every request to `/api/RESOURCE_NAME` must be sent with an api key and token
    - The token will be provided after you've made a call to a resource with the `x-api-key` header
    - After this the token must be sent as `x-token` header

Authentication can also be switched to http basic with the usage of username:password.
To change this, do the following:
- go to `src/Entity/User` and change the constant `API_AUTHENTICATION_METHOD` to the `API_AUTH_KEY_TOKEN`
- go to `config/packages/security.yaml` and uncomment the http basic part and comment the api token part
 
**The authentication is disabled on the `dev` environment.**

