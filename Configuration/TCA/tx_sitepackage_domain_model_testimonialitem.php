<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:tx_sitepackage_domain_model_testimonialitem',
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
        'searchFields' => 'header,subheader,bodytext',
        'iconfile' => 'EXT:sitepackage/Resources/Public/Icons/Content/Testimonials.svg',
        'hideTable' => true,
    ],
    'types' => [
        '1' => [
            'showitem' => 'bodytext, header, subheader, image, --div--:visibility, hidden, starttime, endtime',
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
        'bodytext' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:testimonialitem.bodytext',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 4,
                'enableRichtext' => false,
                'required' => true,
            ],
        ],
        'header' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:testimonialitem.header',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'subheader' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:testimonialitem.subheader',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'image' => [
            'label' => 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:testimonialitem.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', [
                'maxitems' => 1,
            ], 'svg,png,jpg,jpeg'),
        ],
    ],
];
