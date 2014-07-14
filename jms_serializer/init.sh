#!/bin/bash

rm -rf vendor composer.lock

# get composer first
if [ ! -f "composer.phar" ];
then
  curl -sS https://getcomposer.org/installer | php
fi

php composer.phar install

# Apply a bugfix as commented (by Romain) here:
# https://github.com/schmittjoh/serializer/issues/191#issuecomment-29574472
sed -i 's/(isset($metadata->type\[.name.]) && $metadata->type\[.name.\] === .array. && isset($metadata->type\[.params.\]\[1\]))/true/g' vendor/jms/serializer/src/JMS/Serializer/XmlSerializationVisitor.php