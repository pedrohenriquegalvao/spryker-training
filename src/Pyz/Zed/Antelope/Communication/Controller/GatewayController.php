<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method AntelopeFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    public function getAntelopeAction(AntelopeCriteriaTransfer $antelopeCriteria
    ): AntelopeResponseTransfer {
        return $this->getFacade()
            ->getAntelope($antelopeCriteria);
    }
}
