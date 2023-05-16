<?php
/**
 * Class Equipment Model
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

/**
 * Class Equipment Model
 *
 * PHP Version >= 8.1
 *
 * @category Model
 * @package  Model
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
class EquipmentModel {
    /**
     * @var int The ID of the equipment.
     */
    private $id;

    /**
     * @var string The name of the equipment.
     */
    private $name;

    /**
     * @var int The stock of the equipment.
     */
    private $stock;

    // Getters

    /**
     * Gets the ID of the equipment.
     *
     * @return int The ID of the equipment.
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Gets the name of the equipment.
     *
     * @return string The name of the equipment.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Gets the stock of the equipment.
     *
     * @return int The stock of the equipment.
     */
    public function getStock(): int {
        return $this->stock;
    }

    // Setters

    /**
     * Sets the ID of the equipment.
     *
     * @param int $id The ID of the equipment.
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Sets the name of the equipment.
     *
     * @param string $name The name of the equipment.
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Sets the stock of the equipment.
     *
     * @param int $stock The stock of the equipment.
     */
    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    /**
     * Create an instance of the class from an array of data.
     *
     * @param array $data An associative array containing 'id',
     * 'name', and 'stock'.
     *
     * @throws \InvalidArgumentException If 'id', 'name', or 'stock'
     * is not present in $data.
     *
     * @return self A new instance of this class.
     */
    public static function fromArray(array $data): self {
        if (!isset($data['id']) || !isset($data['name'])
            || !isset($data['stock'])) {
            throw new \InvalidArgumentException(
                "Invalid record data: ".json_encode($data));
        }

        $instance = new self();
        $instance->setId($data['id']);
        $instance->setName($data['name']);
        $instance->setStock($data['stock']);
        return $instance;
    }
}

