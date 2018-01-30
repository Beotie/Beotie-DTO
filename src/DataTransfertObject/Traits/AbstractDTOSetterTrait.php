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
namespace Beotie\DTO\Traits;

use Beotie\DTO\DTOInterface;

/**
 * Abstract DTO setter trait
 *
 * This trait is an abstraction layer for AbstractDTO and manage the setter logic
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
trait AbstractDTOSetterTrait
{
    /**
     * Store
     *
     * The property value storage
     *
     * @var array
     */
    private $store = [];

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
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function set($property, $value): DTOInterface
    {
        $this->offsetSet($property, $value);
        return $this;
    }

    /**
     * Offset set
     *
     * Set the value of an offset.
     *
     * @param mixed $offset The offset to set
     * @param mixed $value  The value to inject
     *
     * @see    \ArrayAccess::offsetSet()
     * @return void
     * @throws \OutOfBoundsException If the offset does not exist
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $this->setStorage($offset, $value);
            return;
        }

        throw new \OutOfBoundsException(
            sprintf(
                'Trying to set unexisting offset "%s"',
                $offset
            ),
            500
        );
    }

    /**
     * Set storage
     *
     * Set a storage value, regardless the storage place.
     *
     * @param mixed $elementName The element name
     * @param mixed $value       The value to inject
     *
     * @return void
     */
    private function setStorage($elementName, $value) : void
    {
        if ($this->isProperty($elementName)) {
            $this->{$elementName} = $value;
            return;
        }

        $this->store[$elementName]  = $value;
        return;
    }

    /**
     * Offset exists
     *
     * Validate the offset existance into the store or simply available to be used
     *
     * @param mixed $offset The offset to validate
     *
     * @see    \ArrayAccess::offsetExists()
     * @return bool
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public abstract function offsetExists($offset);
}
