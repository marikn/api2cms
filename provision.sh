#!/usr/bin/env bash

yum update

tee /etc/yum.repos.d/docker.repo <<-'EOF'
[dockerrepo]
name=Docker Repository
baseurl=https://yum.dockerproject.org/repo/main/centos/$releasever/
enabled=1
gpgcheck=1
gpgkey=https://yum.dockerproject.org/gpg
EOF

yum install -y docker-engine

if (( $(ps -ef | grep -v grep | grep docker | wc -l) < 1 ))
then
    service docker start
fi

chkconfig docker on

if [ ! -f /usr/bin/docker-compose ]
then
    curl -Ls https://github.com/docker/compose/releases/download/1.7.1/docker-compose-`uname -s`-`uname -m` > /usr/bin/docker-compose
    chmod +x /usr/bin/docker-compose
fi



cd /www/api2cms/ && docker-compose up -d