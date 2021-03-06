<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Installer
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

ini_set('max_execution_time', 86400);
ini_set('memory_limit', '64M');

include __DIR__.'/../app/bootstrap.php';
include __DIR__.'/install/lib.php';

$kernel = new AppKernel('prod', true);
$kernel->loadClassCache();
$core = new Zikula\Core\Core(__DIR__.'/../src/Resources/config/core.xml', __DIR__.'/../src/EventHandlers', $kernel->getContainer());
$core->boot();

install($core);
