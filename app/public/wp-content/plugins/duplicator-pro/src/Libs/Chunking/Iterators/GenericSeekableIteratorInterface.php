<?php

/**
 * @package   Duplicator
 * @copyright (c) 2022, Snap Creek LLC
 */

namespace Duplicator\Libs\Chunking\Iterators;

/**
 *
 * @author andrea
 *
 * @extends \Iterator<mixed,mixed>
 */
interface GenericSeekableIteratorInterface extends \Iterator
{
    /**
     * @param mixed $position position to seek to
     *
     * @return bool
     */
    public function gSeek($position);

    /**
     * return current position
     *
     * @return mixed
     */
    public function getPosition();

    /**
     * Free resources in current iteration
     *
     * @return void
     */
    public function stopIteration();

    /**
     * Return progress percentage
     *
     * @return float progress percentage or -1 undefined
     */
    public function getProgressPerc();
}
