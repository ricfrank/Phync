Phync
=====

Phing extension for rsync.

Setup
=====

Download composer from https://github.com/composer/composer. and put it in your project root directory.
Clone project and copy ```Deploy.php```, ```composer.json```, ```composer.lock``` and ```build_deploy.xml``` in your project root directory. 
Run composer ```php composer.phar install``` for dependencies (phing and phpunit).
Open ```build_deploy.xml``` and following steps:

* set source directory
* set destination directory (or remote server directory)
* set dry_run parameter to true for --dry-run (simulation)
* set option rsync command


Local deploy
============
Run /path/to/your/project/vendor/phing/phing/bin/phing -f  build_deploy.xml deploy_temp  

Remote deploy
=============
Run /path/to/your/project/vendor/phing/phing/bin/phing -f  build_deploy.xml deploy_staging

  