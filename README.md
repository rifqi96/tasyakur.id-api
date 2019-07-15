# tasyakur.id-api
> Tasyakur.id Backend API

### Getting Started
- Please install docker and docker-compose first if it's not installed on your machine. [Click here](https://www.docker.com/get-started) !
- Please download google analytics json credentials and put it inside ```etc/php/env_files/google```

## Local Environment
- ```$ cp ./local-sample.env ./.env```
- Fill out all necessary env vars
- Env vars:
    - PHP_OPCACHE_VALIDATE_TIMESTAMPS=1

### To Build
```bash
$ ./start.sh local build
or
$ docker-compose -f docker-compose.local.yml up -d --build
```

### To Run
```bash
$ ./start.sh local
or
$ docker-compose -f docker-compose.local.yml up -d
```

### Shut Down
```bash
$ ./stop.sh local
or
$ docker-compose -f docker-compose.local.yml down -v
```

### How-To`s
- Access the app from ```http://localhost:8000```
- Access phpmyadmin from ```http://localhost:306```
- Mysql is accessible through port *3306*
- Redis is accessible through port *6379*
- It opens port *8000*, *6379*, *3306* and *306* once it is run. Hence, please make sure you don't have anything runs on those ports. However, you can change the exposed ports from ```docker-compose.local.yml```.

## Production Environment
- ```$ cp ./production-sample.env ./.env```
- Fill out all necessary env vars
- Env vars:
    - PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

### To Build
```bash
$ ./start.sh production build
```

### To Run
```bash
$ ./start.sh production
```

### Shut Down
```bash
$ ./stop.sh production
```

### How-To`s
- It opens port *80* for the app.
- Master branch is on the production server.
- If there are updates on the app and is expected to be live then it should be on master.
- To update the production server, please ssh into the server, pull the master branch and if there are changes on the server side, then you need to restart the docker-compose.

That's all :)

*(P.S. Please check out [Docker documentation](https://www.docker.com/get-started) to figure out more how it works)*