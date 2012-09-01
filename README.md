Log4PhpBundle
==================================

This is an experimental Bundle whitch supports the [Log4Php] in your 
Symfony2-Project.

[Log4Php]: http://logging.apache.org/log4php/


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
            class: LoggerLayoutPattern
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

There are also information about which logger was call. Mainly it's the root logger. You can setup your own logger and pass it as a argument to the log-method:

    $this->get('logger')->info('MyApp was called', array('app'=>'my.app'));
    
The app option says which logger should be use for the application. If the logger is not configured/unknown, the root logger will be used.

Costum Appenders
================

You can register your own services as an appender.

		<service id="myapp" class="Acme\DemoBundle\MyService">
			<tag name="logger.appender" id="costum.appender" />
		</service>

The service you want to register, needs the tag `logger.appender` and the option `id`. The option `id` represent the name of your appender. If you want to register the appender for a concrete logger (excepting root-logger), you can add the option `logger`.

		<service id="myapp" class="Acme\DemoBundle\MyService">
			<tag name="logger.appender" id="costum.appender" logger="my.logger" />
		</service>
		
Your Service has to extends the \LoggerAppender class from Log4Php.

If the logger is not found, the root logger will be used. How to setup your own logger, take a look at the cookbook or the documentation of Log4Php.


[Log4php Quickstart]: http://logging.apache.org/log4php/quickstart.html
[Log4php Download]: https://github.com/apache/log4php
[wiki]: https://github.com/floriansemm/Log4PhpBundle/wiki/Appenders