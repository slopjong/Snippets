#!/bin/bash

# get composer first
if [ ! -f "composer.phar" ];
then
  curl -sS https://getcomposer.org/installer | php
fi

# then download the dependencies
php composer.phar install

# clone the apps directory
if [ ! -d apps ];
then
    git svn clone https://ifs.kl.dfki.de/repos/ifs/2013-CPSapp/Source/apps/
fi