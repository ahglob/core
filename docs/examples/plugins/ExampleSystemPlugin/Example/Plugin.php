<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

use Zikula\Core\Event\GenericEvent;

/**
 * SystemPlugin_Example_Plugin class.
 */
class SystemPlugin_Example_Plugin extends Zikula_AbstractPlugin
{
    /**
     * Setup handler definitions.
     *
     * @return void
     */
    protected function setupHandlerDefinitions()
    {
        $this->addHandlerDefinition('theme.init', 'handler');
    }

    /**
     * Get plugin meta data.
     *
     * @return array
     */
    protected function getMeta()
    {
        return array('displayname' => $this->__('Example System Plugin'),
                     'description' => $this->__('Adds prefilter to theme instance.'),
                     'version'     => '1.0.0'
                      );
    }

    /**
     * Event handler.
     *
     * @param GenericEvent $event Event.
     *
     * @return void
     */
    public function handler(GenericEvent $event)
    {
        // subject must be an instance of Theme class.
        $theme = $event->getSubject();
        if (!$theme instanceof Theme) {
            return;
        }

        // register output filter to add MultiHook environment if requried
        if (ModUtil::available('MultiHookModule')) {
            $modinfo = ModUtil::getInfoFromName('MultiHookModule');
            if (version_compare($modinfo['version'], '5.0', '>=') == 1) {
                $theme->load_filter('output', 'multihook');
                ModUtil::apiFunc('MultiHookModuleModule', 'theme', 'preparetheme');
            }
        }
    }
}
