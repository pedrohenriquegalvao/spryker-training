<?php 

namespace Pyz\Zed\Training\Persistence; 
use Generated\Shared\Transfer\AntelopeCriteriaTransfer; 
use Generated\Shared\Transfer\AntelopeTransfer; 
use Spryker\Zed\Kernel\Persistence\AbstractRepository; 
use Exception; 

/** * @method \Pyz\Zed\Training\Persistence\TrainingPersistenceFactory getFactory() */ 

class TrainingRepository extends AbstractRepository implements TrainingRepositoryInterface {

   public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeTransfer | null {
         $antelopeEntity = $this->getFactory() 
              ->createAntelopeQuery() 
              ->filterByName($antelopeCriteria->getName()) 
             ->findOne(); 
        if (!$antelopeEntity) { 
           return null;   
        } 
       $antelopeTransfer = new AntelopeTransfer(); 
       return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true); 
   }
} 
