<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_faqitem',
        'label' => 'header',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'header,bodytext',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/Content/Faq.svg',
        'hideTable' => true,
    ],
    'types' => [
        '1' => [
            'showitem' => 'header, bodytext, --div--:visibility, hidden, starttime, endtime',
        ],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => ['type' => 'check', 'default' => 0],
        ],
        'starttime' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
        ],
        'header' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:faqitem.header',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:faqitem.bodytext',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'enableRichtext' => true,
            ],
        ],
    ],
];
