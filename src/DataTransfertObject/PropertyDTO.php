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
 * Property DTO
 *
 * The abstract PropertyDTO designed to offer simplest DTO implementation. It offer a model for DTO
 * that use only properties.
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
abstract class PropertyDTO extends AbstractDTO
{
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
        return [];
    }

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
    protected function getEscapeSet() : array
    {
        return [];
    }
}
