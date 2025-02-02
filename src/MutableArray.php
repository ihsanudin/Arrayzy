<?php

namespace Arrayzy;

use Closure;

/**
 * Class MutableArray
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 */
class MutableArray extends AbstractArray
{
    /**
     * Reindex the array
     *
     * @return $this The same instance with re-indexed elements
     */
    public function reindex()
    {
        $this->elements = array_values($this->elements);

        return $this;
    }

    /**
     * Exchanges all array keys with their associated values
     *
     * @return $this The same instance with flipped elements
     */
    public function flip()
    {
        $this->elements = array_flip($this->elements);

        return $this;
    }

    /**
     * PLace array in reverse order
     *
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return $this The same instance with reversed elements
     */
    public function reverse($preserveKeys = false)
    {
        $this->elements = array_reverse($this->elements, $preserveKeys);

        return $this;
    }

    /**
     * Pad array to the specified size with a given value
     *
     * @param int $size Size of result array
     * @param mixed $value Empty value by default
     *
     * @return $this The same instance with padded elements
     */
    public function pad($size, $value)
    {
        $this->elements = array_pad($this->elements, $size, $value);

        return $this;
    }

    /**
     * Extract a slice of array
     *
     * @param int $offset Offset value of array
     * @param int|null $length Length of sliced array
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return $this The same instance with sliced elements
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        $this->elements = array_slice($this->elements, $offset, $length, $preserveKeys);

        return $this;
    }

    /**
     * Split array into chunks
     *
     * @param int $size Size of each chunk
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return $this The same instance with splitted elements
     */
    public function chunk($size, $preserveKeys = false)
    {
        $this->elements = array_chunk($this->elements, $size, $preserveKeys);

        return $this;
    }

    /**
     * Removes duplicate values from array
     *
     * @param int|null $sortFlags
     *
     * @return $this The same instance with unique elements
     */
    public function unique($sortFlags = null)
    {
        $this->elements = array_unique($this->elements, $sortFlags);

        return $this;
    }

    /**
     * Merges array with given one
     *
     * @param array $array Array for merge
     * @param bool $recursively Whether array will be merged recursively or no
     *
     * @return $this The same instance with merged elements
     */
    public function mergeWith(array $array, $recursively = false)
    {
        if (true === $recursively) {
            $this->elements = array_merge_recursive($this->elements, $array);
        } else {
            $this->elements = array_merge($this->elements, $array);
        }

        return $this;
    }

    /**
     * Merges array to given one
     *
     * @param array $array Array for merge
     * @param bool $recursively Whether array will be merged recursively or no
     *
     * @return $this The same instance with merged elements
     */
    public function mergeTo(array $array, $recursively = false)
    {
        if (true === $recursively) {
            $this->elements = array_merge_recursive($array, $this->elements);
        } else {
            $this->elements = array_merge($array, $this->elements);
        }

        return $this;
    }

    /**
     * Replace array with given one
     *
     * @param array $array Array for replace
     * @param bool $recursively Whether array will be replaced recursively or no
     *
     * @return $this The same instance with replaced elements
     */
    public function replaceWith(array $array, $recursively = false)
    {
        if (true === $recursively) {
            $this->elements = array_replace_recursive($this->elements, $array);
        } else {
            $this->elements = array_replace($this->elements, $array);
        }

        return $this;
    }

    /**
     * Replace array in given one
     *
     * @param array $array Array for replace
     * @param bool $recursively Whether array will be replaced recursively or no
     *
     * @return $this The same instance with replaced elements
     */
    public function replaceIn(array $array, $recursively = false)
    {
        if (true === $recursively) {
            $this->elements = array_replace_recursive($array, $this->elements);
        } else {
            $this->elements = array_replace($array, $this->elements);
        }

        return $this;
    }

    /**
     * Combine array values used as keys with a given array values
     *
     * @param array $array Array for combining
     *
     * @return $this The same instance with combined elements
     */
    public function combineWith(array $array)
    {
        $this->elements = array_combine($this->elements, $array);

        return $this;
    }

    /**
     * Combine array values to a given array values used as keys
     *
     * @param array $array Array for combining
     *
     * @return $this The same instance with combined elements
     */
    public function combineTo(array $array)
    {
        $this->elements = array_combine($array, $this->elements);

        return $this;
    }

    /**
     * Compute the difference of array with given one
     *
     * @param array $array Array for diff
     *
     * @return $this The same instance containing all the entries from array that are not present in given one
     */
    public function diffWith(array $array)
    {
        $this->elements = array_diff($this->elements, $array);

        return $this;
    }

    /**
     * Shuffle array
     *
     * @return $this The same instance with shuffled elements
     */
    public function shuffle()
    {
        shuffle($this->elements);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.arsort.php
     * @link http://php.net/manual/en/function.sort.php
     * @link http://php.net/manual/en/function.asort.php
     * @link http://php.net/manual/en/function.rsort.php
     */
    public function sort($order = SORT_ASC, $strategy = SORT_REGULAR, $preserveKeys = false)
    {
        parent::sorting($this->elements, $order, $strategy, $preserveKeys);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.ksort.php
     * @link http://php.net/manual/en/function.krsort.php
     */
    public function sortKeys($order = SORT_ASC, $strategy = SORT_REGULAR)
    {
        parent::sortingKeys($this->elements, $order, $strategy);

        return $this;
    }

    /**
     * Apply the given function to the array elements
     *
     * @param Closure $func
     *
     * @return $this The same instance with modified elements
     */
    public function map(Closure $func)
    {
        $this->elements = array_map($func, $this->elements);

        return $this;
    }

    /**
     * Filter array elements with given function
     *
     * @param Closure $func
     *
     * @return $this The same instance with filtered elements
     */
    public function filter(Closure $func)
    {
        $this->elements = array_filter($this->elements, $func);

        return $this;
    }

    /**
     * Apply the given function to every array element
     *
     * @param Closure $func
     * @param bool $recursively Whether array will be walked recursively or no
     *
     * @return $this The same instance with modified elements
     */
    public function walk(Closure $func, $recursively = false)
    {
        if (true === $recursively) {
            array_walk_recursive($this->elements, $func);
        } else {
            array_walk($this->elements, $func);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.usort.php
     */
    public function customSort(Closure $func)
    {
        usort($this->elements, $func);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.uksort.php
     */
    public function customSortKeys(Closure $func)
    {
        uksort($this->elements, $func);

        return $this;
    }

    /**
     * Clear array
     *
     * @return $this The same instance with cleared elements
     */
    public function clear()
    {
        $this->elements = [];

        return $this;
    }
}
