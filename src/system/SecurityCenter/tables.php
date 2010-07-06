<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Zikula
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */


/**
 * Populate pntables array for securitycenter module.
 *
 * @return array pntables array.
 */
function securitycenter_tables()
{
    // Initialise table array
    $dbtable = array();

    // IDS intrusions table
    $dbtable['sc_intrusion'] = DBUtil::getLimitedTablename('sc_intrusion');
    $dbtable['sc_intrusion_column'] = array('id'        => 'ids_id',
                                            'name'      => 'ids_name',
                                            'tag'       => 'ids_tag',
                                            'value'     => 'ids_value',
                                            'page'      => 'ids_page',
                                            'uid'       => 'ids_uid',
                                            'ip'        => 'ids_ip',
                                            'impact'    => 'ids_impact',
                                            'date'      => 'ids_date');

    $dbtable['sc_intrusion_column_def'] = array('id'        => 'I PRIMARY AUTO',
                                                'name'      => 'C(128) NOTNULL DEFAULT \'\'',
                                                'tag'       => 'C(40) DEFAULT NULL',
                                                'value'     => 'X NOTNULL',
                                                'page'      => 'X NOTNULL', // C(255)
                                                'uid'       => 'I4 DEFAULT NULL',
                                                'ip'        => 'C(40) NOTNULL DEFAULT \'\'', // C(15)
                                                'impact'    => 'I4 NOTNULL DEFAULT \'0\'',
                                                'date'      => 'T NOTNULL');

    // Return the table information
    return $dbtable;
}
