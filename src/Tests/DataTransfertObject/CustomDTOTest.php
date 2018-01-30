<?php
declare(strict_types=1);
/**
 * This file is part of beotie/dto
 *
 * As each files provides by the CSCFA, this file is licensed
 * under the MIT license.
 *
 * PHP version 7.1
 *
 * @category Test
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
namespace Beotie\DTO\Tests;

use PHPUnit\Framework\TestCase;
use Beotie\DTO\PropertyDTO;

/**
 * Custom DTO test
 *
 * This class is used to validate the CustomDTO instance logic
 *
 * @category Test
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
class CustomDTOTest extends TestCase
{
    /**
     * Test has
     *
     * This method is used to validate the CustomDTO::has logic
     *
     * @return void
     */
    public function testHas() : void
    {
        $instance = $this->getCustomDTO();

        $this->assertTrue($instance->has('propertyOne'));
        $this->assertFalse($instance->has('unreachableProperty'));

        return;
    }

    /**
     * Test get
     *
     * This method is used to validate the CustomDTO::get logic
     *
     * @return void
     */
    public function testGet() : void
    {
        $instance = $this->getCustomDTO();

        $reflex = new \ReflectionProperty($instance, 'propertyOne');
        $reflex->setAccessible(true);
        $reflex->setValue($instance, 'value');

        $this->assertEquals('value', $instance->get('propertyOne'));

        return;
    }

    /**
     * Test invalid get
     *
     * This method is used to validate the CustomDTO::get logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidGet() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to get unexisting offset "unreachableProperty"');
        $instance = $this->getCustomDTO();
        $instance->get('unreachableProperty');

        return;
    }

    /**
     * Test set
     *
     * This method is used to validate the CustomDTO::set logic
     *
     * @return void
     */
    public function testSet() : void
    {
        $instance = $this->getCustomDTO();

        $reflex = new \ReflectionProperty($instance, 'propertyOne');
        $reflex->setAccessible(true);

        $this->assertNull($reflex->getValue($instance));
        $this->assertSame($instance, $instance->set('propertyOne', 'value'));
        $this->assertEquals('value', $reflex->getValue($instance));

        return;
    }

    /**
     * Test invalid set
     *
     * This method is used to validate the CustomDTO::set logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidSet() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to set unexisting offset "unreachableProperty"');
        $instance = $this->getCustomDTO();
        $instance->set('unreachableProperty', 'value');

        return;
    }

    /**
     * Test unset
     *
     * This method is used to validate the CustomDTO::offsetUnset logic
     *
     * @return void
     */
    public function testUnset() : void
    {
        $instance = $this->getCustomDTO();

        $reflex = new \ReflectionProperty($instance, 'propertyOne');
        $reflex->setAccessible(true);
        $reflex->setValue($instance, 'value');

        $instance->offsetUnset('propertyOne');
        $this->assertNull($reflex->getValue($instance));

        return;
    }

    /**
     * Test invalid unset
     *
     * This method is used to validate the CustomDTO::offsetUnset logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidUnset() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to unset unexisting offset "unreachableProperty"');
        $instance = $this->getCustomDTO();
        $instance->offsetUnset('unreachableProperty');

        return;
    }

    /**
     * Get custom dto
     *
     * Return an on the fly custom DTO
     *
     * @return                                      anonymous class instance
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     * @codingStandardsIgnoreStart
     */
    private function getCustomDTO()
    {
        // @codingStandardsIgnoreEnd
        return new class() extends PropertyDTO {
            public $propertyOne;

            public $unreachableProperty;

            /**
             * Get escape set
             *
             * Define here the properties of your DTO that you want to use as internal and does not be accessed behind
             * the AbstractDTO logic.
             * The return value is expected to be a set of valid string.
             * Note to merge the result in case of extend.
             *
             * @return  array
             * @example <pre>
             *   return ['isImmutable', 'offsetList', ... ];
             * </pre>
             */
            protected function getEscapeSet() : array
            {
                return array_merge(parent::getEscapeSet(), ['unreachableProperty']);
            }
        };
    }
}
