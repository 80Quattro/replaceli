<?php

declare(strict_types=1);

/**
 * This file is part of the "replaceli" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace StudioMitte\Replaceli\Hooks;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class ReplaceCharHook
{

    public function run(array $params, TypoScriptFrontendController $typoScriptFrontendController)
    {
        $siteLanguage = $this->getCurrentSiteLanguage();
        if ($siteLanguage instanceof SiteLanguage) {
            $enabled = $siteLanguage->toArray()['replaceli'] ?? false;
            if ($enabled) {
                $typoScriptFrontendController->content = str_replace('ß', 'ss', $typoScriptFrontendController->content);
            }
        }
    }

    /**
     * Returns the currently configured "site language" if a site is configured (= resolved)
     * in the current request.
     *
     * @return SiteLanguage|null
     */
    protected function getCurrentSiteLanguage(): ?SiteLanguage
    {
        if ($GLOBALS['TYPO3_REQUEST'] instanceof ServerRequestInterface) {
            return $GLOBALS['TYPO3_REQUEST']->getAttribute('language', null);
        }
        return null;
    }
}