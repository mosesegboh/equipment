<?php
/**
 * Class Planning Repository
 *
 * PHP Version >= 8.1
 *
 * @category Repository
 * @package  Repository
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
namespace Repository;

use Assessment\Availability\EquimentAvailabilityHelper;
use Model\PlanningModel;

/**
 * Class Planning Repository
 *
 * PHP Version >= 8.1
 *
 * @category Repository
 * @package  Repository
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
class PlanningRepository
{
    /**
     * Database connection
     *
     * @var  $connection
     */
    private $connection;

    /**
     * EquipmentRepository constructor.
     *
     * @param $dbConnection
     */
    public function __construct(EquimentAvailabilityHelper $helper)
    {
        $this->connection = $helper->getDatabaseConnection();
    }

    public function findPlanningsByEquipmentId($equipmentId)
    {
        $stmt = $this->connection
            ->prepare("SELECT * FROM planning WHERE equipment = :equipment");
        $stmt->execute([':equipment' => $equipmentId]);
        $planningsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $plannings = [];
        foreach ($planningsData as $planningData) {
            $planning = new PlanningModel();
            $planning->setId($planningData['id']);
            $planning->setEquipment($planningData['equipment']);
            $planning->setQuantity($planningData['quantity']);
            $planning->setStart(new \DateTime($planningData['start']));
            $planning->setEnd(new \DateTime($planningData['end']));
            $plannings[] = $planning;
        }

        return $plannings;
    }

    /**
     * Get the planning of equipment of a specific equipment within a time frame
     *
     * @param int $equipment_id
     * @param DateTime $start
     * @param DateTime $end
     *
     * @return array
     */
    public function findPlanningsByEquipmentIdAndTimeframe($equipmentId,
       \DateTime $start,
       \DateTime $end): array
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM planning WHERE equipment = :equipmentId 
                        AND ((start <= :start AND end >= :end) 
                        OR (start >= :start AND start <= :end) 
                        OR (end >= :start AND end <= :end))'
        );
        $stmt->bindValue(':equipmentId', $equipmentId, \PDO::PARAM_INT);
        $stmt->bindValue(':start', $start->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $stmt->bindValue(':end', $end->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
