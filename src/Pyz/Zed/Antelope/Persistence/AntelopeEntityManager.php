<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements
    AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();
        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()
            ->filterByIdAntelope($antelopeTransfer->getIdAntelope())
            ->findOne();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();
        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ) : AntelopeLocationTransfer {
        $antelopeLocationEntity = new PyzAntelopeLocation();
        
        $antelopeLocationEntity->fromArray($antelopeLocationTransfer->modifiedToArray());
        $antelopeLocationEntity->save();
        return $antelopeLocationTransfer->fromArray($antelopeLocationEntity->toArray(), true);
    }

}
