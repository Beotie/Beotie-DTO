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

/**
 * Abstract DTO getter trait
 *
 * This trait is an abstraction layer for AbstractDTO and manage the getter logic
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
trait AbstractDTOGetterTrait
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
     * Get
     *
     * Return a property value.
     *
     * @param mixed $property The property name whence get the value
     *
     * @return mixed
     * @throws \OutOfBoundsException If the property does not exist
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function get($property)
    {
        return $this->offsetGet($property);
    }

    /**
     * Offset get
     *
     * Return the value of a given offset
     *
     * @param mixed $offset The offset to get
     *
     * @see    \ArrayAccess::offsetGet()
     * @return mixed
     * @throws \OutOfBoundsException If the offset does not exist
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->getStorage($offset);
        }

        throw new \OutOfBoundsException(
            sprintf(
                'Trying to get unexisting offset "%s"',
                $offset
            ),
            500
        );
    }

    /**
     * Get storage
     *
     * Return a stored value, or null if it's not set.
     *
     * @param mixed $elementName The element name
     *
     * @return mixed|NULL
     */
    private function getStorage($elementName)
    {
        if ($this->isProperty($elementName)) {
            return $this->{$elementName};
        }

        return ($this->store[$elementName] ?? null);
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
