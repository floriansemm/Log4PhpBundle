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

    Go to `src/vendor` and execute:

        $ git clone https://github.com/apache/log4php.git

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
          layout: 
            class: LoggerLayoutTTCC
          params:
            file: %kernel.root_dir%/logs/default.log  
      rootLogger: 
        level: DEBUG
        appenders: [ default ]


Sample config for a simple file-logger. Config for other logger-types see the [wiki].

Symfony-Profiler
================

The Bundle has it's own part in the profiler. This section is named "All Logs".

In the main-panel there are different sections. Each section represent a log-level. So you can see all logs of the current request, group by the the log-level.


[Log4php Quickstart]: http://logging.apache.org/log4php/quickstart.html
[Log4php Download]: https://github.com/apache/log4php
[wiki]: https://github.com/floriansemm/Log4PhpBundle/wiki/Appenders