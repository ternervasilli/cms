<?php

declare(strict_types=1);

namespace CmsSitepackage\Sitepackage\DataProcessing;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\FrontendRestrictionContainer;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Resolves the IRRE child records (feature items, FAQ items,
 * testimonial items) that belong to a Sitepackage container
 * content element and assigns them to the Fluid template as a
 * plain array, in backend sort order. FAL relations named in
 * "fileFields" are resolved into real FileReference objects so
 * they can be used with <f:image> directly.
 *
 * TypoScript usage:
 *
 * dataProcessing {
 *   10 = CmsSitepackage\Sitepackage\DataProcessing\ChildRecordsProcessor
 *   10 {
 *     table = tx_sitepackage_domain_model_featureitem
 *     parentField = parentid
 *     fileFields = image
 *     as = items
 *   }
 * }
 */
final class ChildRecordsProcessor implements DataProcessorInterface
{
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $table = (string)$cObj->stdWrapValue('table', $processorConfiguration);
        $parentField = (string)($cObj->stdWrapValue('parentField', $processorConfiguration) ?: 'parentid');
        $as = (string)($cObj->stdWrapValue('as', $processorConfiguration) ?: 'items');
        $fileFields = GeneralUtility::trimExplode(
            ',',
            (string)$cObj->stdWrapValue('fileFields', $processorConfiguration),
            true
        );
        $parentUid = (int)($processedData['data']['uid'] ?? 0);

        if ($table === '' || $parentUid === 0) {
            $processedData[$as] = [];
            return $processedData;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(FrontendRestrictionContainer::class, GeneralUtility::makeInstance(Context::class)));

        $rows = $queryBuilder
            ->select('*')
            ->from($table)
            ->where(
                $queryBuilder->expr()->eq(
                    $parentField,
                    $queryBuilder->createNamedParameter($parentUid, \Doctrine\DBAL\ParameterType::INTEGER)
                )
            )
            ->orderBy('sorting')
            ->executeQuery()
            ->fetchAllAssociative();

        if ($fileFields !== []) {
            $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
            foreach ($rows as &$row) {
                foreach ($fileFields as $fileField) {
                    if ((int)($row[$fileField] ?? 0) > 0) {
                        $row[$fileField] = $fileRepository->findByRelation($table, $fileField, (int)$row['uid']);
                    } else {
                        $row[$fileField] = [];
                    }
                }
            }
            unset($row);
        }

        $processedData[$as] = $rows;

        return $processedData;
    }
}
