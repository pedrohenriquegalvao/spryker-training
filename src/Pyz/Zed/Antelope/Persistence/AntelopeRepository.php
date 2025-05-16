<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * @method AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     * @throws AmbiguousComparisonException
     */
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeTransfer {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
            $antelopeCriteriaTransfer->getName(),
        )->findOne();
        if ($antelopeEntity === null) {
            throw new EntityNotFoundException(sprintf('Antelope %s not found', $antelopeCriteriaTransfer->getName()));
        }
        return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(),
            true);
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteria,
    ): AntelopeLocationResponseTransfer {
        if ($antelopeLocationCriteria->getIdAntelopeLocation() !== null) {
            return $this->getAntelopeLocationById($antelopeLocationCriteria->getIdAntelopeLocation());
        }
        if ($antelopeLocationCriteria->getLocationName() === null) {
            throw new EntityNotFoundException('No Antelope Location given');
        }

        return $this->getAntelopeLocationByName($antelopeLocationCriteria->getLocationName());
    }


    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(int $idLocation): AntelopeLocationResponseTransfer
    {
        $antelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()->findPk($idLocation);

        if ($antelopeLocationEntity === null) {
            throw new EntityNotFoundException(sprintf('Antelope Location %d not found', $idLocation));
        }
        $antelopeLocation = (new AntelopeLocationTransfer())->fromArray(
            $antelopeLocationEntity->toArray(),
            true,
        );
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        $antelopeLocationResponseTransfer->setAntelopeLocationOrFail($antelopeLocation);

        return $antelopeLocationResponseTransfer;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationByName(string $antelopeLocationName): AntelopeLocationResponseTransfer
    {
        $antelopeLocationEntity = $this->getFactory()
            ->createAntelopeLocationQuery()->findByLocationName($antelopeLocationName);

        if ($antelopeLocationEntity === null) {
            throw new EntityNotFoundException(sprintf('Antelope Location %d not found', $antelopeLocationEntity));
        }
        $antelopeLocation = (new AntelopeLocationTransfer())->fromArray(
            $antelopeLocationEntity->toArray(),
            true,
        );
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        $antelopeLocationResponseTransfer->setAntelopeLocationOrFail($antelopeLocation);

        return $antelopeLocationResponseTransfer;
    }

    public function findAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $criteriaTransfer,
    ): AntelopeLocationCollectionTransfer {
        $query = $this->getFactory()->createAntelopeLocationQuery();

        if ($criteriaTransfer->getLocationName() !== null) {
            $query->filterByLocationName($criteriaTransfer->getLocationName());
        }
        if ($criteriaTransfer->getIdAntelopeLocation() !== null) {
            $query->filterByLocationName($criteriaTransfer->getIdAntelopeLocation());
        }

        $antelopeLocations = $query->find();

        $antelopeLocationMapper = $this->getFactory()->createAntelopeLocationMapper();
        $collectionTransfer = $antelopeLocationMapper->mapAntelopeLocationEntitiesToCollectionTransfer(
            $antelopeLocations,
        );

        return $collectionTransfer;
    }

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        $query = $this->getFactory()->createAntelopeQuery();

        if ($antelopeCriteriaTransfer->getName() !== null) {
            $query->filterByName($antelopeCriteriaTransfer->getName());
        }

        $antelopeEntities = $query->find();
        $antelopeMapper = $this->getFactory()->createAntelopeMapper();
        return $antelopeMapper->mapAntelopeEntityCollectionToAntelopeCollectionTransfer(
            $antelopeEntities
        );
    }
}
