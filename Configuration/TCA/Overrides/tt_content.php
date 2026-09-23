<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function (): void {
    $llFile = 'LLL:EXT:sitepackage/Resources/Private/Language/locallang_db.xlf:';

    // --------------------------------------------------------------
    // Additional fields
    // --------------------------------------------------------------
    ExtensionManagementUtility::addTCAcolumns('tt_content', [
        'tx_sitepackage_button_label' => [
            'label' => $llFile . 'tt_content.button_label',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'tx_sitepackage_feature_items' => [
            'label' => $llFile . 'tt_content.feature_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_sitepackage_domain_model_featureitem',
                'foreign_field' => 'parentid',
                'foreign_default_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => false,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                ],
            ],
        ],
        'tx_sitepackage_faq_items' => [
            'label' => $llFile . 'tt_content.faq_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_sitepackage_domain_model_faqitem',
                'foreign_field' => 'parentid',
                'foreign_default_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => false,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                ],
            ],
        ],
        'tx_sitepackage_testimonial_items' => [
            'label' => $llFile . 'tt_content.testimonial_items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_sitepackage_domain_model_testimonialitem',
                'foreign_field' => 'parentid',
                'foreign_default_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => false,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                ],
            ],
        ],
    ]);

    // --------------------------------------------------------------
    // Register the new content element group + CTypes
    // --------------------------------------------------------------
    ExtensionManagementUtility::addTcaSelectItemGroup(
        table: 'tt_content',
        field: 'CType',
        groupId: 'sitepackage',
        groupLabel: 'Sitepackage',
        position: 'after:default'
    );

    $newContentElements = [
        'sitepackage_hero' => [
            'label' => $llFile . 'tt_content.CType.sitepackage_hero',
            'icon' => 'content-sitepackage-hero',
        ],
        'sitepackage_feature_highlight' => [
            'label' => $llFile . 'tt_content.CType.sitepackage_feature_highlight',
            'icon' => 'content-sitepackage-feature-highlight',
        ],
        'sitepackage_faq' => [
            'label' => $llFile . 'tt_content.CType.sitepackage_faq',
            'icon' => 'content-sitepackage-faq',
        ],
        'sitepackage_testimonials' => [
            'label' => $llFile . 'tt_content.CType.sitepackage_testimonials',
            'icon' => 'content-sitepackage-testimonials',
        ],
        'sitepackage_cta_banner' => [
            'label' => $llFile . 'tt_content.CType.sitepackage_cta_banner',
            'icon' => 'content-sitepackage-cta-banner',
        ],
    ];

    foreach ($newContentElements as $CType => $config) {
        ExtensionManagementUtility::addTcaSelectItem(
            table: 'tt_content',
            field: 'CType',
            item: [
                'label' => $config['label'],
                'value' => $CType,
                'icon' => $config['icon'],
                'group' => 'sitepackage',
            ],
            relativeToField: '',
            relativePosition: ''
        );
    }

    // --------------------------------------------------------------
    // "types" showitem definitions per CType
    // --------------------------------------------------------------
    $GLOBALS['TCA']['tt_content']['types']['sitepackage_hero'] = [
        'showitem' => '
            --div--:' . $llFile . 'tt_content.tab.content,
                header,
                bodytext,
                image,
                tx_sitepackage_button_label,
                header_link,
            --div--:' . $llFile . 'tt_content.tab.appearance,
                --palette--;;frames,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,
                categories,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.access,
                --palette--;;language,
                --palette--;;hidden,
                --palette--;;access,
        ',
        'columnsOverrides' => [
            'header' => ['label' => $llFile . 'hero.header'],
            'bodytext' => ['label' => $llFile . 'hero.bodytext', 'config' => ['enableRichtext' => false]],
            'image' => ['label' => $llFile . 'hero.image'],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['sitepackage_feature_highlight'] = [
        'showitem' => '
            --div--:' . $llFile . 'tt_content.tab.content,
                header,
                bodytext,
                image,
                tx_sitepackage_feature_items,
            --div--:' . $llFile . 'tt_content.tab.appearance,
                --palette--;;frames,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,
                categories,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.access,
                --palette--;;language,
                --palette--;;hidden,
                --palette--;;access,
        ',
        'columnsOverrides' => [
            'header' => ['label' => $llFile . 'featureHighlight.header'],
            'bodytext' => ['label' => $llFile . 'featureHighlight.bodytext', 'config' => ['enableRichtext' => false]],
            'image' => ['label' => $llFile . 'featureHighlight.image'],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['sitepackage_faq'] = [
        'showitem' => '
            --div--:' . $llFile . 'tt_content.tab.content,
                header,
                bodytext,
                tx_sitepackage_faq_items,
            --div--:' . $llFile . 'tt_content.tab.appearance,
                --palette--;;frames,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.access,
                --palette--;;language,
                --palette--;;hidden,
                --palette--;;access,
        ',
        'columnsOverrides' => [
            'header' => ['label' => $llFile . 'faq.header'],
            'bodytext' => ['label' => $llFile . 'faq.bodytext', 'config' => ['enableRichtext' => false]],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['sitepackage_testimonials'] = [
        'showitem' => '
            --div--:' . $llFile . 'tt_content.tab.content,
                header,
                tx_sitepackage_testimonial_items,
            --div--:' . $llFile . 'tt_content.tab.appearance,
                --palette--;;frames,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.access,
                --palette--;;language,
                --palette--;;hidden,
                --palette--;;access,
        ',
        'columnsOverrides' => [
            'header' => ['label' => $llFile . 'testimonials.header'],
        ],
    ];

    $GLOBALS['TCA']['tt_content']['types']['sitepackage_cta_banner'] = [
        'showitem' => '
            --div--:' . $llFile . 'tt_content.tab.content,
                header,
                bodytext,
                tx_sitepackage_button_label,
                header_link,
            --div--:' . $llFile . 'tt_content.tab.appearance,
                --palette--;;frames,
            --div--:LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.access,
                --palette--;;language,
                --palette--;;hidden,
                --palette--;;access,
        ',
        'columnsOverrides' => [
            'header' => ['label' => $llFile . 'ctaBanner.header'],
            'bodytext' => ['label' => $llFile . 'ctaBanner.bodytext', 'config' => ['enableRichtext' => false]],
        ],
    ];

    // --------------------------------------------------------------
    // Extra "frame in frontend" (frame_class) options used by the
    // design: an edge-to-edge 4-up image gallery strip and a
    // grayscale press/logo bar - both built on the CORE "image" CE.
    // --------------------------------------------------------------
    ExtensionManagementUtility::addTcaSelectItem(
        table: 'tt_content',
        field: 'frame_class',
        item: [
            'label' => $llFile . 'frameClass.galleryStrip',
            'value' => 'sitepackage-gallery-strip',
        ]
    );
    ExtensionManagementUtility::addTcaSelectItem(
        table: 'tt_content',
        field: 'frame_class',
        item: [
            'label' => $llFile . 'frameClass.logoBar',
            'value' => 'sitepackage-logo-bar',
        ]
    );
})();
