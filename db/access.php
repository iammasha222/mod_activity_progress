<?php

defined('MOODLE_INTERNAL') || die();

$capabilities = array (
    'block/activity_progress:addinstance' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'user' => CAP_ALLOW
        ),
        'clonepermissionsform' => 'moodle/site:managerblocks'
    ),
    
    'block/activity_progress:addinstance' => array(
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' =>  CAP_ALLOW,
        ),
        'clonepermissionsform' => 'moodle/my:manageblock'
    )

);