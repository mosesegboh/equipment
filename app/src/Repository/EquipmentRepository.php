<?php
/**
 * Class EquipmentRepository
 *
 * PHP Version >= 8.1
 *
 * @category Repository
 * @package  Repository
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equipment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
namespace Repository;

use Model\EquipmentModel;

use Assessment\Availability\EquimentAvailabilityHelper;

/**
 * Class EquipmentRepository
 *
 * PHP Version >= 8.1
 *
 * @category Repository
 * @package  Repository
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
class EquipmentRepository
{
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

    /**
     * Finds equipment by its ID.
     *
     * @param int $id The ID of the equipment.
     *
     * @return EquipmentModel|null The EquipmentModel object if found, null otherwise.
     */
    public function findEquipmentById(int $id): ?EquipmentModel
    {
        $stmt = $this->connection
            ->prepare("SELECT * FROM equipment WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $equipmentData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($equipmentData) {
            $equipment = new EquipmentModel();
            $equipment->setId($equipmentData['id']);
            $equipment->setName($equipmentData['name']);
            $equipment->setStock($equipmentData['stock']);
            return $equipment;
        }

        return null;
    }

    /**
     * Finds all equipments.
     *
     * @return array An array of all equipments. Each element is an associative array representing an equipment.
     */
    public function findAllEquipments(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM equipment');
        $statement->execute();

        $equipmentsData = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $equipmentsData ? $equipmentsData : [];
    }
}


