<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPv2.1 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Context menu separator
 *
 * This plugin represents a menu item.
 *
 * @see Form_Plugin_ContextMenu
 */
class Form_Plugin_ContextMenu_Separator extends Form_Plugin
{
    function getFilename()
    {
        return __FILE__;
    }

    function render(&$render)
    {
        $contextMenu =& $this->getParentContextMenu();

        // Avoid creating menu multiple times if included in a repeated template
        if (!$contextMenu->firstTime()) {
            return '';
        }

        return "<li class=\"separator\">&nbsp;</li>";
    }

    function & getParentContextMenu()
    {
        // Locate parent context menu
        $contextMenu = &$this->parentPlugin;

        while ($contextMenu != null  &&  strcasecmp(get_class($contextMenu), 'pnformcontextmenu') != 0) {
            $contextMenu = &$contextMenu->parentPlugin;
        }

        return $contextMenu;
    }
}
