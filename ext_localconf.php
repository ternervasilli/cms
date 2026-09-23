<?php

defined('TYPO3') or die();

(function (): void {
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

    $contentIcons = [
        'content-sitepackage-hero' => 'Hero.svg',
        'content-sitepackage-feature-highlight' => 'FeatureHighlight.svg',
        'content-sitepackage-faq' => 'Faq.svg',
        'content-sitepackage-testimonials' => 'Testimonials.svg',
        'content-sitepackage-cta-banner' => 'CtaBanner.svg',
    ];

    foreach ($contentIcons as $identifier => $file) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:sitepackage/Resources/Public/Icons/Content/' . $file]
        );
    }
})();
