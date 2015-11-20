<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),    
    'manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Process-manager',
        'children' => array(
            'guest',          
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'manager',
        ),
        'bizRule' => null,
        'data' => null
    ),
);
