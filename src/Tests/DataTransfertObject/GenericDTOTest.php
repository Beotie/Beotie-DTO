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
use Beotie\DTO\GenericDTO;
use Beotie\DTO\AbstractDTO;

/**
 * Generic DTO test
 *
 * This class is used to validate the GenericDTO instance logic
 *
 * @category Test
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
class GenericDTOTest extends TestCase
{
    /**
     * Test construct
     *
     * This method is used to validate the GenericDTO::__construct logic
     *
     * @return void
     */
    public function testConstruct() : void
    {
        $instance = new GenericDTO();
        $reflex = new \ReflectionProperty(GenericDTO::class, 'offsetList');
        $reflex->setAccessible(true);

        $this->assertInstanceOf(\ArrayObject::class, $reflex->getValue($instance));

        $initiator = new \ArrayObject();
        $instance = new GenericDTO($initiator);
        $this->assertSame($initiator, $reflex->getValue($instance));

        return;
    }

    /**
     * Test has
     *
     * This method is used to validate the GenericDTO::has logic
     *
     * @return void
     */
    public function testHas() : void
    {
        $initiator = new \ArrayObject(['array_key']);
        $instance = new GenericDTO($initiator);

        $this->assertTrue($instance->has('array_key'));

        return;
    }

    /**
     * Test get
     *
     * This method is used to validate the GenericDTO::get logic
     *
     * @return void
     */
    public function testGet() : void
    {
        $initiator = new \ArrayObject(['array_key']);
        $instance = new GenericDTO($initiator);

        $reflex = new \ReflectionProperty(AbstractDTO::class, 'store');
        $reflex->setAccessible(true);
        $reflex->setValue($instance, ['array_key' => 'array_value']);

        $this->assertEquals('array_value', $instance->get('array_key'));

        return;
    }

    /**
     * Test set
     *
     * This method is used to validate the GenericDTO::set logic
     *
     * @return void
     */
    public function testSet() : void
    {
        $initiator = new \ArrayObject(['array_key']);
        $instance = new GenericDTO($initiator);

        $reflex = new \ReflectionProperty(AbstractDTO::class, 'store');
        $reflex->setAccessible(true);

        $this->assertEmpty($reflex->getValue($instance));
        $this->assertSame($instance, $instance->set('array_key', 'array_value'));
        $this->assertEquals(['array_key' => 'array_value'], $reflex->getValue($instance));

        return;
    }

    /**
     * Test invalid get
     *
     * This method is used to validate the GenericDTO::get logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidGet() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to get unexisting offset "array_key"');
        $instance = new GenericDTO();
        $instance->get('array_key');

        return;
    }

    /**
     * Test invalid set
     *
     * This method is used to validate the GenericDTO::set logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidSet() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to set unexisting offset "array_key"');
        $instance = new GenericDTO();
        $instance->set('array_key', 'array_value');

        return;
    }

    /**
     * Test unset
     *
     * This method is used to validate the GenericDTO::offsetUnset logic
     *
     * @return void
     */
    public function testUnset() : void
    {
        $initiator = new \ArrayObject(['array_key']);
        $instance = new GenericDTO($initiator);

        $reflex = new \ReflectionProperty(AbstractDTO::class, 'store');
        $reflex->setAccessible(true);
        $reflex->setValue($instance, ['array_key' => 'array_value']);

        $instance->offsetUnset('array_key');
        $this->assertEmpty($reflex->getValue($instance));

        return;
    }

    /**
     * Test invalid unset
     *
     * This method is used to validate the GenericDTO::offsetUnset logic in case of invalid offset
     *
     * @return void
     */
    public function testInvalidUnset() : void
    {
        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('Trying to unset unexisting offset "array_key"');
        $instance = new GenericDTO();
        $instance->offsetUnset('array_key');

        return;
    }

    /**
     * Test offset process list
     *
     * This method is used to validate the AbstractDTO::processList logic in case of invalid argument
     *
     * @return void
     */
    public function testOffsetProcessList() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The getOffsetList method is expected to return a set of valid string');

        $initiator = new \ArrayObject([128]);
        $instance = new GenericDTO($initiator);

        $reflex = new \ReflectionMethod(AbstractDTO::class, 'processList');
        $reflex->setAccessible(true);

        $reflex->invoke($instance, 0b0);

        return;
    }

    /**
     * Test get escape set
     *
     * This method is used to validate the GenericDTO::getEscapeSet logic
     *
     * @return void
     */
    public function testGetEscapeSet() : void
    {
        $instance = new GenericDTO();

        $reflex = new \ReflectionMethod(GenericDTO::class, 'getEscapeSet');
        $reflex->setAccessible(true);

        $this->assertEquals(['offsetList'], $reflex->invoke($instance));

        return;
    }
}
