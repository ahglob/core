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
 * Drop down list
 *
 * Renders an HTML <select> element with the supplied items.
 *
 * You can set the items directly like this:
 * <code>
 * <!--[formdropdownlist id="mylist" items=$items]-->
 * </code>
 * with the form event handler code like this:
 * <code>
 * class mymodule_user_testHandler extends pnFormHandler
 * {
 *   function initialize(&$render)
 *   {
 *       $items = array( array('text' => 'A', 'value' => '1'),
 *                       array('text' => 'B', 'value' => '2'),
 *                       array('text' => 'C', 'value' => '3') );
 *
 *       $render->assign('items', $items); // Supply items
 *       $render->assign('mylist', 2);     // Supply selected value
 *   }
 * }
 * </code>
 * Or you can set them indirectly using the plugin's databased features:
 * <code>
 * <!--[formdropdownlist id="mylist"]-->
 * </code>
 * with the form event handler code like this:
 * <code>
 * class mymodule_user_testHandler extends pnFormHandler
 * {
 *   function initialize(&$render)
 *   {
 *       $items = array( array('text' => 'A', 'value' => '1'),
 *                       array('text' => 'B', 'value' => '2'),
 *                       array('text' => 'C', 'value' => '3') );
 *
 *       $render->assign('mylistItems', $items);  // Supply items
 *       $render->assign('mylist', 2);            // Supply selected value
 *   }
 * }
 * </code>
 *
 * Selected index is zero based. Selected value is a string - and the PHP null
 * value is also a valid value.
 *
 * Option groups can be added by setting an 'optgroup' attribute on each item.
 * For instance:
 *
 * <code>
 * class mymodule_user_testHandler extends pnFormHandler
 * {
 *   function initialize(&$render)
 *   {
 *       $items = array( array('text' => 'A', 'value' => '1', 'optgroup' => 'AAA'),
 *                       array('text' => 'B', 'value' => '2', 'optgroup' => 'BBB'),
 *                       array('text' => 'C', 'value' => '3', 'optgroup' => 'CCC') );
 *
 *       $render->assign('mylistItems', $items);  // Supply items
 *       $render->assign('mylist', 2);            // Supply selected value
 *   }
 * }
 * </code>
 *
 * You can also encourage reuse of dropdown lists by inheriting from
 * the dropdown list into a specialized list a'la MyCategorySelector or
 * MyColorSelector, and then use this plugin where ever you want
 * a category or color selector. In this way you don't have to remember
 * to assign the items to the render every time you need such a selector.
 * In these plugins you must set the items in the load event handler.
 * See {@link pnFormLanguageSelector} for a good example of how this
 * can be done.
 *
 * @package pnForm
 * @subpackage Plugins
 */
function smarty_function_formdropdownlist($params, &$render)
{
    return $render->RegisterPlugin('Form_Plugin_DropdownList', $params);
}
