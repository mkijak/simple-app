FROM mongo:latest

ADD mongod.conf /etc/mongod.conf

VOLUME [ "/data/db" ]
EXPOSE 27017 27017

RUN sudo mongod --auth&
