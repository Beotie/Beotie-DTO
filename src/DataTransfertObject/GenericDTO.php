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
 * Generic DTO
 *
 * The generic DTO allow to create a DTO without extending or implementing the DTO logic.
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
class GenericDTO extends PropertyDTO
{
    /**
     * Offset list
     *
     * The available offset list of the DTO.
     *
     * @var \ArrayObject
     */
    private $offsetList;

    /**
     * Construct
     *
     * The default GenericDTO constructor
     *
     * @param \ArrayObject $offsetList The offset list of the DTO
     *
     * @return GenericDTO
     */
    public function __construct(\ArrayObject $offsetList = null)
    {
        $this->offsetList = ($offsetList ?? new \ArrayObject());
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
    protected function getOffsetList() : array
    {
        return $this->offsetList->getArrayCopy();
    }

    /**
     * Get escape set
     *
     * Define here the properties of your DTO that you want to use as internal and does not be accessed behind the
     * AbstractDTO logic.
     * The return value is expected to be a set of valid string.
     * Note to merge the result in case of extend.
     *
     * @return  array
     * @example <pre>
     *   return ['isImmutable', 'offsetList', ... ];
     * </pre>
     */
    protected function getEscapeSet(): array
    {
        return ['offsetList'];
    }
}
