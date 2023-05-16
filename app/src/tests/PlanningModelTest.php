<?php
/**
 * Class PlanningModelTest
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
use Model\PlanningModel;

/**
 * Class PlanningModelTest
 *
 * PHP Version >= 8.1
 *
 * @category Test
 * @package  Test
 * @author   Moses Egboh <mosesegboh@yahoo.com>
 * @license  https://github.com/mosesegboh/equiment.git MIT
 * @link     https://github.com/mosesegboh/equipment.git
 */
final class PlanningModelTest extends TestCase
{
    /**
     * Tests if a PlanningModel object can be created
     * from a valid array record.
     *
     * @return void
     */
    public function testCanBeCreatedFromValidRecord(): void
    {
        $this->assertInstanceOf(
            PlanningModel::class,
            PlanningModel::fromArray([
                'id' => 1,
                'equipment' => 1,
                'quantity' => 2,
                'start' => '2023-01-01 00:00:00',
                'end' => '2023-01-02 00:00:00'
            ])
        );
    }

    /**
     * Tests if an exception is thrown when attempting
     * to create a PlanningModel object from an invalid array record.
     *
     * @return void
     */
    public function testCannotBeCreatedFromInvalidRecord(): void
    {

        $this->expectException(\InvalidArgumentException::class);

        PlanningModel::fromArray([
            'id' => 1,
            'equipment' => 1,
            'quantity' => 2,
            'end' => '2023-01-02']);
    }
}
