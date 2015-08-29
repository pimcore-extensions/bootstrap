#!/usr/bin/env bash

VERSION=$1

if [ -z $VERSION ]; then
    echo "Provide version number"
fi

sed -i -r "s/(<pluginVersion>).*(<\/pluginVersion>)/\1${VERSION}\2/" plugin.xml
find . -name area.xml -exec sed -i -r "s/(<version>).*(<\/version>)/\1${VERSION}\2/" {} \;

echo "Version bumped to ${VERSION}"
