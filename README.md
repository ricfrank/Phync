Phync
=====

Phing extension for rsync.

Setup
=====

Clone project and run composer ```php composer.phar install``` for dependencies (phing and phpunit).
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