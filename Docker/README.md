# Project 5

## Project Overview

- Part 1: Docker Basics & Dockerfile
	- Installed Docker and dependencies 
	- Built and ran the container 
	- Viewed project in browser 
- Part 2: GitHub Actions & DockerHub
	- Create DockerHub Public Repo
	- Generated an access token in DockerHub
	- Authenticated DockerHub in the terminal 
	- Configured GitHub secrets to hold DockerHub username and access token
	- Configuered GitHub workflow to build, authenticate, and push the image to DockerHub
- Part 3: Deployment
	- Created a container restart script to redeploy the image on an EC2 Instance
	- Created a webhook task to call the redeploy script
	- Installed webhook with Go
	
	
## Part 1: Docker Basics & Dockerfile

### Run Project Locally

- How To Install Dockor and Dependencies 
   - `sudo apt install apt-transport-https ca-certificates curl software-properties-common` to install dependencies
   - WSL2 would not properly run Docker, so I installed Docker Desktop.
   
- How To Build a Container
   - Create `Dockerfile` in the project directory 
   - Once completed and inside project directory, `docker build .` builds the container
   
- How To Run the Container
   - `docker run -dit -p 8080:80 7caed60cb76d` where `7caed60cb76d` is the image ID

- How To View the Project
   - Open a browser and go to [localhost:8080](http://localhost:8080/)


## Part 2: GitHub Actions & DockerHub

### Create DockerHub Public Repo
1. On [DockerHub](https://hub.docker.com/), go to `Repositories`
2. Click the blue `Create Repository` button
3. Name the repo and add a description
4. Select `Public` for the repo visibility
5. Click the blue `Create` button at the bottom

### How to Authenticate with DockerHub via CLI using DockerHub credentials
- Utilize the DockerHub Access Tokens
	- Under Profile, go to settings > Security > Access Tokens > New Access Token
	- Add a description, and select `Read, Write, Delete` for the Scope, then Click `Generate`
	- `docker login -u cybersmith22` entered into the command line will prompt for a password, enter the given token 

### Configuring GitHub Secrets 
- Needed the username and either a password or access token (recommended)
	- In the project GitHub repo, go to Settings Tab > Secrets > Actions > New repository secret
	- Give the secret a name and value, then click `Add Secret`

### Behavior of GitHub workflow
- With every push to the master branch on GitHub, the Docker image is built, logged into DockerHub, and then pushed to my 
DockerHub Repo
- Variables that were changed: DOCKER_HUB_REPO (cicd-3120-cybersmith-22), DOCKER_HUB_USERNAME, DOCKER_HUB_ACCESS_TOKEN


## Part 3: Deployment

### Container Restart Script
- Stops old running container, clearing the host port
- Removes stopped container, without prompt
- Pulls the image post prune
- Runs the new image

### Webhook Task Definition File
- Names the ID of the hook
- Specifies the command that is called when the hook is triggered
- Points to the working directory that the script uses when executed

### Setting Up a Webhook on the Server
- Installed webhook on an EC2 Instance with [Go](https://go.dev/doc/install) 
	- `wget https://go.dev/dl/go1.18.1.linux-amd64.tar.gz` downloads the Go archived file, which is needed to install webhook
	- `rm -rf /usr/local/go` deletes the /usr/local/go folder if it already exists in preparation for the next step
	- `sudo tar -C /usr/local -xzf go1.18.1.linux-amd64.tar.gz` extracts the file into /usr/local/go
	- add `export PATH=$PATH:/usr/local/go/bin` to ~/.profile
	- Check that Go has installed properly `go version`
	- `go install github.com/adnanh/webhook@latest` installs webhook

### Setting Up a Notifier in DockerHub
- In the DockerHub Repo, under the Webhooks tab, add a name for the webhook and the webhook url 
- Click the blue create button on the right
- Test that the link works by navigating to it in the browser
- Verify it appears in the terminal and on DockerHub


## Part 4: Diagramming 

[![GitHub Workflow](https://mermaid.ink/img/pako:eNpdkUFuwyAQRa8yYhVLyQW8qBTHVhupi6px1Q0bChMb2YA1QKsqzt1LahKlZTUS7319mBOTTiErWUdi6qGtuYV0tqtHHZ7iB7xE3xew2TzA_O5oOI7uC5pPtAFa0l2HNEO1enadthAc1E4OSMkrlpjdNeaAkjB42EqJ3qPKkTce3jySFQZTXFb_E4sKrRvQ3qjql6pXeyM6hCrqMRT3N3f-jlCl3lqMPtWxYYYma5c3ovrTH15xcjmpXpIWNpvcsjUzSEZolT7vdCE5Cz0a5KxMoxI0cMbtOXFxUiJgo3RwxMpjKoBrJmJwh28rWRko4hWqtUiLMJk6_wBIkIZM)](https://mermaid.live/edit#pako:eNpdkUFuwyAQRa8yYhVLyQW8qBTHVhupi6px1Q0bChMb2YA1QKsqzt1LahKlZTUS7319mBOTTiErWUdi6qGtuYV0tqtHHZ7iB7xE3xew2TzA_O5oOI7uC5pPtAFa0l2HNEO1enadthAc1E4OSMkrlpjdNeaAkjB42EqJ3qPKkTce3jySFQZTXFb_E4sKrRvQ3qjql6pXeyM6hCrqMRT3N3f-jlCl3lqMPtWxYYYma5c3ovrTH15xcjmpXpIWNpvcsjUzSEZolT7vdCE5Cz0a5KxMoxI0cMbtOXFxUiJgo3RwxMpjKoBrJmJwh28rWRko4hWqtUiLMJk6_wBIkIZM)
