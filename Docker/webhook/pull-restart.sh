#!/bin/bash

# stop old running container (to clear host port)
docker stop project5

# remove stopped containers, without prompt
docker system prune -f

# pull image post prune
docker pull cybersmith22/cicd-3120-cybersmith-22:latest

# run new image
docker run -d --name project5 -p 80:80 cybersmith22/cicd-3120-cybersmith-22:latest
