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
 * Abstract DTO unset trait
 *
 * This trait is an abstraction layer for AbstractDTO and manage the unset logic
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
trait AbstractDTOUnsetTrait
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
     * Offset unset
     *
     * Remove an offset from the store
     *
     * @param mixed $offset The offset to unset
     *
     * @see    \ArrayAccess::offsetUnset()
     * @return void
     * @throws \OutOfBoundsException If the offset does not exist
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $this->unsetStorage($offset);
            return;
        }

        throw new \OutOfBoundsException(
            sprintf(
                'Trying to unset unexisting offset "%s"',
                $offset
            ),
            500
        );
    }

    /**
     * Unset storage
     *
     * Remove storage value regardless storage place.
     *
     * @param mixed $elementName The element name
     *
     * @return void
     */
    private function unsetStorage($elementName) : void
    {
        if ($this->isProperty($elementName)) {
            $this->{$elementName} = null;
            return;
        }

        unset($this->store[$elementName]);
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
