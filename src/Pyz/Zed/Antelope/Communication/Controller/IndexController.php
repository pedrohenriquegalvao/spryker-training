<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\Antelope\Communication\AntelopeCommunicationFactory getFactory()
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopes = $this->getFacade()->getAntelopeCollection($antelopeCriteriaTransfer)->getAntelopes();
        return $this->viewResponse(['antelopes' => $antelopes]);
    }
}
