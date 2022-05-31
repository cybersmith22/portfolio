FROM httpd:latest

RUN apt update && apt install -y python3 python3-pip && pip3 install python-dotenv

COPY ./website/index.html /usr/local/apache2/htdocs/

EXPOSE 80
