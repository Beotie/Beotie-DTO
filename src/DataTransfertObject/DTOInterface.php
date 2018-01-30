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
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
namespace Beotie\DTO;

/**
 * DTO interface
 *
 * ThE DataTransfertObjects are used to represent request informations regardless request format
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
interface DTOInterface extends \ArrayAccess
{
    /**
     * Get
     *
     * Return a property value.
     *
     * @param mixed $property The property name whence get the value
     *
     * @return mixed
     * @throws \OutOfBoundsException If the property does not exist
     */
    public function get($property);

    /**
     * Set
     *
     * Set a property value.
     *
     * @param mixed $property The property name where inject the value
     * @param mixed $value    The value to inject
     *
     * @return DTOInterface
     * @throws \OutOfBoundsException If the property does not exist
     */
    public function set($property, $value) : DTOInterface;

    /**
     * Has
     *
     * Return a property existance state
     *
     * @param mixed $property The property name to validate
     *
     * @return bool
     */
    public function has($property) : bool;
}
