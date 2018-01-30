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
 * Abstract DTO exist trait
 *
 * This trait is an abstraction layer for AbstractDTO and manage the existance logic
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
trait AbstractDTOExistTrait
{
    /**
     * Has
     *
     * Return a property existance state
     *
     * @param mixed $property The property name to validate
     *
     * @return bool
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    public function has($property): bool
    {
        return $this->offsetExists($property);
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
    public function offsetExists($offset)
    {
        return $this->hasStorage($offset);
    }

    /**
     * Has storage
     *
     * Validate a storage place exist. Can be a class property or a stored key.
     *
     * @param mixed $elementName The element name
     *
     * @return boolean
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    private function hasStorage($elementName) : bool
    {
        if ($this->isProperty($elementName) || $this->isStored($elementName)) {
            return true;
        }

        return false;
    }

    /**
     * Is property
     *
     * Validate that an element name is a valid property name into the static class
     *
     * @param mixed $elementName The element name
     *
     * @return bool
     */
    private function isProperty($elementName) : bool
    {
        if (is_string($elementName)
            && property_exists(static::class, $elementName)
            && $elementName != 'store'
            && !in_array($elementName, $this->processList(self::GET_ESCAPE))
        ) {
                return true;
        }

            return false;
    }

    /**
     * Is stored
     *
     * Validate that an element name is a valid storage key
     *
     * @param mixed $elementName The element name
     *
     * @return bool
     * @throws \InvalidArgumentException In the case of getOffsetList return an invalid set of string
     */
    private function isStored($elementName) : bool
    {
        if (is_string($elementName) && in_array($elementName, $this->processList(self::GET_OFFSET))) {
            return true;
        }

        return false;
    }

    /**
     * Process list
     *
     * Return a list and validate each element is a valid string value
     *
     * @param int $listType The list type. Can be self::GET_OFFSET or self::GET_ESCAPE to refer to
     *                      static::getOffsetList or static::getEscapeSet, respectively
     *
     * @return array
     * @throws \InvalidArgumentException In the case of the list retreiver return an invalid set of string
     */
    private function processList(int $listType) : array
    {
        $map = ['getOffsetList', 'getEscapeSet'];
        $list = $this->{$map[$listType]}();

        foreach ($list as $element) {
            if (!is_string($element)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'The %s method is expected to return a set of valid string',
                        $map[$listType]
                    )
                );
            }
        }

        return $list;
    }

    /**
     * Get offset list
     *
     * Define here the availables offset for your DTO.
     * Return an array of available offsets to be setted or getted.
     * The return value is expected to be a set of valid string.
     *
     * @return  array
     * @example <pre>
     *   return ['firstname', 'lastname', 'age', ... ];
     * </pre>
     */
    abstract protected function getOffsetList() : array;

    /**
     * Get escape set
     *
     * Define here the properties of your DTO that you want to use as internal and does not be accessed behind the
     * AbstractDTO logic.
     * The return value is expected to be a set of valid string.
     *
     * @return  array
     * @example <pre>
     *   return ['isImmutable', 'offsetList', ... ];
     * </pre>
     */
    abstract protected function getEscapeSet() : array;
}
