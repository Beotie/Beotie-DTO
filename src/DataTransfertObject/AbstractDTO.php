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

use Beotie\DTO\Traits\AbstractDTOSetterTrait;
use Beotie\DTO\Traits\AbstractDTOGetterTrait;
use Beotie\DTO\Traits\AbstractDTOExistTrait;
use Beotie\DTO\Traits\AbstractDTOUnsetTrait;

/**
 * Abstract DTO
 *
 * The abstract DataTransfertObjectis designed to offer simplest DTO implementation. Just be redifining getOffsetList
 * method, the abstract DTO will manage the availables properties.
 * In case of extend, the child property will be automatically considered as available storage place.
 *
 * @category DTO
 * @package  Beotie_DTO
 * @author   matthieu vallance <matthieu.vallance@cscfa.fr>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     http://cscfa.fr
 */
abstract class AbstractDTO implements DTOInterface
{
    use AbstractDTOSetterTrait,
        AbstractDTOGetterTrait,
        AbstractDTOExistTrait,
        AbstractDTOUnsetTrait;

    /**
     * Get offset
     *
     * This constant refer to the static::getOffsetList method during the AbstractDTO::processList invocation
     *
     * @var int
     */
    private const GET_OFFSET = 0b0;

    /**
     * Get escape
     *
     * This constant refer to the static::getEscapeSet method during the AbstractDTO::processList invocation
     *
     * @var int
     */
    private const GET_ESCAPE = 0b1;
}
