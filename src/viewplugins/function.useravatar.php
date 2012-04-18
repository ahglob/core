<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula_View
 * @subpackage Template_Plugins
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

use Users\Constants as UsersConstant;

/**
 * Zikula_View function to display the avatar of a user
 *
 * Example
 * {useravatar uid="2"}
 *
 * @param array       $params All attributes passed to this function from the template.
 * @param Zikula_View $view   Reference to the Zikula_View object.
 *
 * @return string A formatted string containing the avatar image.
 */

function smarty_function_useravatar($params, Zikula_View $view)
{
    if (!isset($params['uid'])) {
        $view->trigger_error("Error! Missing 'uid' attribute for useravatar.");
        return false;
    }

    $email           = UserUtil::getVar('email', $params['uid']);
    $avatar          = UserUtil::getVar('avatar', $params['uid']);
    $uname           = UserUtil::getVar('uname', $params['uid']);
    $avatarpath      = ModUtil::getVar(UsersConstant::MODNAME, UsersConstant::MODVAR_AVATAR_IMAGE_PATH, UsersConstant::DEFAULT_AVATAR_IMAGE_PATH);
    $allowgravatars  = ModUtil::getVar(UsersConstant::MODNAME, UsersConstant::MODVAR_GRAVATARS_ENABLED, UsersConstant::DEFAULT_GRAVATARS_ENABLED);
    $gravatarimage   = ModUtil::getVar(UsersConstant::MODNAME, UsersConstant::MODVAR_GRAVATAR_IMAGE, UsersConstant::DEFAULT_GRAVATAR_IMAGE);

    if (isset($avatar) && !empty($avatar) && $avatar != $gravatarimage && $avatar != 'blank.gif') {
        $avatarURL = System::getBaseUrl() . $avatarpath . '/' . $avatar;
    } else if (($avatar == $gravatarimage) && ($allowgravatars == 1)) {
        if (!isset($params['rating'])) $params['rating'] = false;
        if (!isset($params['size'])) $params['size'] = 80;

        $avatarURL = 'http://www.gravatar.com/avatar.php?gravatar_id=' . md5($email);
        if (isset($params['rating']) && !empty($params['rating'])) $avatarURL .= "&rating=".$params['rating'];
        if (isset($params['size']) && !empty($params['size'])) $avatarURL .="&size=".$params['size'];
        $avatarURL .= "&default=".urlencode(System::getBaseUrl() . $avatarpath . '/' . $gravatarimage);
    } else {
        // e.g. blank.gif or empty avatars
        return false;
    }

    $classString = '';
    if (isset($params['class'])) {
        $classString = "class=\"$params[class]\" ";
    }

    $html = '<img ' . $classString . ' src="' . DataUtil::formatForDisplay($avatarURL) . '" title="' . DataUtil::formatForDisplay($uname) . '" alt="' . DataUtil::formatForDisplay($uname) . '" />';

    if (isset($params['assign'])) {
        $view->assign($params['assign'], $avatarURL);
    } else {
        return $html;
    }

}