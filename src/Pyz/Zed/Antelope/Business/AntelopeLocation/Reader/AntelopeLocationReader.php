<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepository $antelopeRepository
    ) {
    }


    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(
        int $idLocation
    ): AntelopeLocationTransfer {
        try {
            return $this->antelopeRepository->getAntelopeLocationById($idLocation);
        } catch (EntityNotFoundException $exception) {
            throw new EntityNotFoundException(
                sprintf('Antelope Location %d not found', $idLocation),
                $exception->getCode(),
                $exception
            );
        }
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteria,
    ): AntelopeLocationResponseTransfer {
        return $this->antelopeRepository->getAntelopeLocation($antelopeLocationCriteria);
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->findAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
    }
}