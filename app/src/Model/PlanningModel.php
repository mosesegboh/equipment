<?php
/**
 * Class Planning Model
 *
 * PHP Version >= 8.1
 *
 * @category Model
 * @package  Model
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
namespace Model;

use DateTime;

/**
 * Class Planning Model
 *
 * PHP Version >= 8.1
 *
 * @category Model
 * @package  Model
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
class PlanningModel
{
    /**
     * @var int The ID of the planning entry.
     */
    private $id;

    /**
     * @var int The ID of the equipment for the planning entry.
     */
    private $equipment;

    /**
     * @var int The quantity of the equipment for the planning entry.
     */
    private $quantity;

    /**
     * @var DateTime The start date of the planning entry.
     */
    private $start;

    /**
     * @var DateTime The end date of the planning entry.
     */
    private $end;

    // Getters

    /**
     * Gets the ID of the planning entry.
     *
     * @return int The ID of the planning entry.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Gets the ID of the equipment for the planning entry.
     *
     * @return int The ID of the equipment for the planning entry.
     */
    public function getEquipment(): int {
        return $this->equipment;
    }

    /**
     * Gets the quantity of the equipment for the planning entry.
     *
     * @return int The quantity of the equipment for the planning entry.
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * Gets the start date of the planning entry.
     *
     * @return DateTime The start date of the planning entry.
     */
    public function getStart(): DateTime {
        return $this->start;
    }

    /**
     * Gets the end date of the planning entry.
     *
     * @return DateTime The end date of the planning entry.
     */
    public function getEnd(): DateTime {
        return $this->end;
    }

    // Setters

    /**
     * Sets the ID of the planning entry.
     *
     * @param int $id The ID of the planning entry.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Sets the ID of the equipment for the planning entry.
     *
     * @param int $equipment The ID of the equipment for the planning entry.
     */
    public function setEquipment(int $equipment): void {
        $this->equipment = $equipment;
    }

    /**
     * Sets the quantity of the equipment for the planning entry.
     *
     * @param int $quantity The quantity of the equipment for the planning entry.
     */
    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    /**
     * Sets the start date of the planning entry.
     *
     * @param DateTime $start The start date of the planning entry.
     */
    public function setStart(DateTime $start): void {
        $this->start = $start;
    }

    /**
     * Sets the end date of the planning entry.
     *
     * @param DateTime $end The end date of the planning entry.
     */
    public function setEnd(DateTime $end): void {
        $this->end = $end;
    }

    /**
     * Create an instance of the class from an array of data.
     *
     * @param array $data An associative array containing 'id',
     * 'name', and 'stock'.
     *
     * @throws \InvalidArgumentException If 'id', 'name', or
     * 'stock' is not present in $data.
     *
     * @return self A new instance of this class.
     */
    public static function fromArray(array $data): self {
        if (!isset($data['id']) || !isset($data['equipment'])
            || !isset($data['quantity'])
            || !isset($data['start'])
            || !isset($data['end'])) {
            throw new \InvalidArgumentException(
                "Invalid record data: ".json_encode($data));
        }

        $instance = new self();
        $instance->setId($data['id']);
        $instance->setEquipment($data['equipment']);
        $instance->setQuantity($data['quantity']);
        $instance->setStart(new DateTime($data['start']));
        $instance->setEnd(new DateTime($data['end']));
        return $instance;
    }
}
