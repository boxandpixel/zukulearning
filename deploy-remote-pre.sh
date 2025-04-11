#!/bin/bash
echo "nodejs 18.16.0" >> ~/.tool-versions
CWD=`pwd`
cd wp-content/themes/densmore/
npm install -g npm
npm install
npm run build
rm -rf ./node_modules
cd $CWD
# move wp core
rm -rf ./wp/wp-content
mv -v ./wp/* ./
rm -rf ./wp/
