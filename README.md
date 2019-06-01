# Typo3Camp - Application Logging with Sentry

- Was ist Application Logging ? 
- Unterschied zum Serverlogging

# Sentry - Service/Self-Hostet/Docker
Sentry Servie / Info: https://sentry.io/
Sentry OnPremise Repository https://github.com/getsentry/onpremise

    $ docker volume create --name=sentry-data && docker volume create --name=sentry-postgres
    $ cp -n .env.example .env
    $ docker-compose build` - Build and tag the Docker services
    $ docker-compose run --rm web config generate-secret-key
    # Add it to `.env` as `SENTRY_SECRET_KEY`.
    $ docker-compose run --rm web upgrade
    $ docker-compose up -d

Open http://localhost:9000

Sentry
    - MultiOrganization
    - MultiTeam
    - MultiProject
    - Multi Coding Languages/Client SDK's/Integragtion

## Beispiele - PHP Plain

Hürde - alten 1.9.2er SDK Nehmen, da die 2 nicht per Composer installierbar ist(Abhängiges Paket nicht verfügbar)

$ cd sentry-demo && composer install
$ php index.php
oder im WebBrowser aufrufen.

Standard Exception/Error Handler Registrieren:

    // copied from project - displayed/provided in Sentry WebApp on Project Creation
    $client = new Raven_Client('http://cf5dc3ae75c344258ee36aa517a63ce3:b9fe378ac3e3438c897c1e737108aad1@localhost:9001/2');

    // automatic error and exception capturierng
    $error_handler = new Raven_ErrorHandler($client);
    $error_handler->registerExceptionHandler();
    $error_handler->registerErrorHandler();
    $error_handler->registerShutdownFunction();

    

## Beispiele - JavaScript

sentry-demo/javascript.html im Browser aufrufen
