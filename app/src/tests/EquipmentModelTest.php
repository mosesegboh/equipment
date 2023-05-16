<?php
/**
 * Class EquipmentModelTest
 *
 * PHP Version >= 8.1
 *
 * @category Test
 * @package  Test
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
include __DIR__ . '/../../bootstrap.php';

use PHPUnit\Framework\TestCase;
use Model\EquipmentModel;

/**
 * Class EquipmentModelTest
 *
 * PHP Version >= 8.1
 *
 * @category Test
 * @package  Test
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
final class EquipmentModelTest extends TestCase
{
    /**
     * Tests if an EquipmentModel object can be created from a
     * valid array record.
     *
     * @return void
     */
    public function testCanBeCreatedFromValidRecord(): void
    {
        $this->assertInstanceOf(
            EquipmentModel::class,
            EquipmentModel::fromArray([
                'id' => 1,
                'name' => 'Hammer',
                'stock' => 10
            ])
        );
    }

    /**
     * Tests if an exception is thrown when attempting to create
     * an EquipmentModel object from an invalid array record.
     *
     * @return void
     */
    public function testCannotBeCreatedFromInvalidRecord(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        EquipmentModel::fromArray(['id' => 1, 'name' => 'Test Equipment']);
    }

    /**
     * Tests if an EquipmentModel object can be used as a string
     * (via its getName method).
     *
     * @return void
     */
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'Hammer',
            EquipmentModel::fromArray([
                'id' => 1,
                'name' => 'Hammer',
                'stock' => 10
            ])->getName()
        );
    }
}
