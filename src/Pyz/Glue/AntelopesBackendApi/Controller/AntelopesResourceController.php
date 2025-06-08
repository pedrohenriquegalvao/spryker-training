<?php

namespace Pyz\Glue\AntelopesBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiFactory getFactory()
 */
class AntelopesResourceController extends AbstractController
{
   public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
   {
        return $this->getFactory()->createAntelopesReader()->getAntelopeCollection($glueRequestTransfer);
   }
}