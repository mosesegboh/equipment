<?php
/**
 * Class EquimentAvailabilityHelperAssessment
 *
 * PHP Version >= 8.1
 *
 * @category EquimentAvailabilityHelperAssessment
 * @package  EquimentAvailabilityHelperAssessment
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiments.git MIT
 * @link     https://github.com/mosesegboh/equipments.git
 */
namespace Assessment\Availability\Todo;

use Assessment\Availability\EquimentAvailabilityHelper;
use Exception;
use Repository\EquipmentRepository;
use Repository\PlanningRepository;
use \PDO;

/**
 * Class EquimentAvailabilityHelperAssessment
 *
 * PHP Version >= 8.1
 *
 * @category EquimentAvailabilityHelperAssessment
 * @package  EquimentAvailabilityHelperAssessment
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiments.git MIT
 * @link     https://github.com/mosesegboh/equipments.git
 */
class EquimentAvailabilityHelperAssessment extends EquimentAvailabilityHelper
{

    private EquipmentRepository $equipmentRepository;
    private PlanningRepository $planningRepository;
    private $connection;

    /**
     * EquimentAvailabilityHelperAssessment constructor.
     *
     * @param EquipmentRepository   $equipmentRepository   Equipment Repository
     * @param PlanningRepository    $planningRepository    Planning Repository
     */
    public function __construct(PDO $oDatabaseConnection)
    {
        parent::__construct($oDatabaseConnection);
        $this->equipmentRepository = new EquipmentRepository($this);
        $this->planningRepository = new PlanningRepository($this);
    }

    /**
     * Checks if a given quantity is available in the passed time frame
     *
     * @param int      $equipment_id Id of the equipment item
     * @param int      $quantity How much should be available
     * @param DateTime $start Start of time window
     * @param DateTime $end End of time window
     * @return bool True if available, false otherwise
     * @throws Exception
     */
    public function isAvailable(int $equipment_id,
                                int $quantity,
                                \DateTime $start,
                                \DateTime $end) : bool {
        $equipment = $this->equipmentRepository
            ->findEquipmentById($equipment_id);

        if (!$equipment) {
            return false;
        }

        $plannings = $this->planningRepository
            ->findPlanningsByEquipmentId($equipment_id);

        foreach ($plannings as $planning) {
            if (($planning->getStart() < $end)
                && ($planning->getEnd() > $start)) {
                $quantity += $planning->getQuantity();
            }
        }

        return $quantity <= $equipment->getStock();
    }

    /**
     * Calculate all items that are short in the given period
     * @param DateTime $start Start of time window
     * @param DateTime $end End of time window
     * @return array Key/value array with as indices the equipment id's and as values the shortages
     * @throws Exception
     */
    public function getShortages(\DateTime $start, \DateTime $end) : array
    {
        $shortages = [];
        $equipments = $this->equipmentRepository->findAllEquipments();

        foreach ($equipments as $equipment) {
            $totalPlannedQuantity = 0;

            $planningEntries = $this->planningRepository
                ->findPlanningsByEquipmentIdAndTimeframe($equipment['id'], $start, $end);

            foreach ($planningEntries as $planning) {
                $totalPlannedQuantity += $planning['quantity'];
            }

            $shortage = $equipment['stock'] - $totalPlannedQuantity;

            if ($shortage < 0) {
                $shortages[$equipment['id']] = $shortage;
            }
        }

        return $shortages;
    }


}
