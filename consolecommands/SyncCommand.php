<?php
namespace Craft;

class SyncCommand extends BaseCommand
{

    public function actionPlugin()
    {
        echo "Synchronizing plugins\n";
        if (!craft()->config->exists('activePlugins', 'plugins')) {
            echo "You need to specify plugins in craft/config/plugins.php before using this functionality.\n";
        }
        $requiredPlugins = array_merge(['Console'], craft()->config->get('activePlugins', 'plugins'));
        $currentPlugins = craft()->plugins->getPlugins(false);

        foreach ($currentPlugins as $plugin) {

            $pluginClassHandle = $plugin->getClassHandle();

            if (in_array($pluginClassHandle, $requiredPlugins)) {

                // This plugin should be activated
                if (!$plugin->isInstalled) {
                    echo "Installing $pluginClassHandle plugin.\n";
                    craft()->plugins->installPlugin($pluginClassHandle);
                } elseif (!$plugin->isEnabled) {
                    echo "Enabling $pluginClassHandle plugin.\n";
                    craft()->plugins->enablePlugin($pluginClassHandle);
                } else {
                    echo "Plugin $pluginClassHandle is already active.\n";
                }

            } else {

                // This plugin should be deactivated
                if ($plugin->isEnabled) {
                    echo "Disabling $pluginClassHandle plugin.\n";
                    craft()->plugins->disablePlugin($pluginClassHandle);
                }

            }
        }
    }

}
