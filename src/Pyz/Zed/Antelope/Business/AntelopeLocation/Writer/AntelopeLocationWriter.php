<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;

use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

class AntelopeLocationWriter {

    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager
    ) {

    }
    
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $this->entityManager->createAntelopeLocation($antelopeLocationTransfer);
    }

}