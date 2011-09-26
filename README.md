Log4PhpBundle
==================================

This is an experimental Bundle whitch supports the [Log4Php] in your 
Symfony2-Project.

[Log4Php]: http://logging.apache.org/log4php/

Future releases provide a mail-interface for different mail-services. 

Installation
============

1.  Register bundle in AppKernel.php

        # app/AppKernel.php

        $bundles = array(
            // ...
            new FS\Log4PhpBundle\FSLog4PhpBundle(),
            // ...
        );

2.  Add Bundle to autoload

        # app/autoload.php

        $loader->registerNamespaces(array(
            // ...
            'FS' => __DIR__.'/../vendor/bundles',
            // ...
        ));

3.  Download and unpack Log4Php to vendor

    Download [Log4php Download] an unzip the whole to vendor

4.  Add Log4Php to autoload 

        # app/autoload.php

        AnnotationRegistry::registerFile(__DIR__.'/../vendor/log4php/src/main/php/Logger.php');


Usage
=====

Use Log4Php without Symfony2 see [Log4php Quickstart]

        app/config.yml

        fs_log4_php:
          appenders:
            default: 
              class: LoggerAppenderFile
              file: %kernel.root_dir%/logs/default.log
              layout: 
                class: LoggerLayoutTTCC
          rootLogger: 
            level: DEBUG
            appenders: [ default ]


Sample config for a simple file-logger. Config for other logger-types coming soon.


[Log4php Quickstart]: http://logging.apache.org/log4php/quickstart.html
[Log4php Download]: http://logging.apache.org/log4php/download.html