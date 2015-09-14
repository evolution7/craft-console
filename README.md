#Craft Console

Command/Task runner for Craft CMS. This enables you to run Craft's commands from the CLI.

## Installation

This plugin can be easily added to any composer-managed Craft project.

```
composer require evolution7/craft-console
```

##Usage

From the project root, run:

```
bin/console
```

This will give you a list of available commands.

```
Yii command runner (based on Yii v1.1.16)
Usage: bin/console <command-name> [parameters...]

The following commands are available:
 - base
 - migrate
 - querygen
 - shell
 - sync

To see individual command help, use the following:
   bin/console help <command-name>
```

### Synchronise plugins between deployments

The plugin comes with an example `sync` task that activates the plugins you want (to be run on deployment):

```
bin/console sync plugin
```

This task reads the content of `craft/config/plugins.php` and activates/deactivates plugins accordingly:

```
<?php
//craft/config/plugins.php
return [
    'activePlugins' => [
        'Project',
        'ArtVandelay',
        'Bugsnag',
        'Console',
        'SproutForms',
        'SproutSeo',
    ]
];
```

Output: 

```
$ php bin/console sync plugin
Synchronizing plugins
Plugin ArtVandelay is already active.
Installing Bugsnag plugin.
Plugin Console is already active.
Enabling Project plugin.
Plugin SproutForms is already active.
Plugin SproutSeo is already active.
```
