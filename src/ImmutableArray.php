<?php

namespace Arrayzy;

use Closure;

/**
 * Class ImmutableArray
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 */
class ImmutableArray extends AbstractArray
{
    /**
     * Reindex the array
     *
     * @return static The new instance with re-indexed elements
     */
    public function reindex()
    {
        return new static(array_values($this->elements));
    }

    /**
     * Exchanges all array keys with their associated values
     *
     * @return static The new instance with flipped elements
     */
    public function flip()
    {
        return new static(array_flip($this->elements));
    }

    /**
     * PLace array in reverse order
     *
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return static The new instance with reversed elements
     */
    public function reverse($preserveKeys = false)
    {
        return new static(array_reverse($this->elements, $preserveKeys));
    }

    /**
     * Pad array to the specified size with a given value
     *
     * @param int $size Size of result array
     * @param mixed $value Empty value by default
     *
     * @return static The new instance with padded elements
     */
    public function pad($size, $value)
    {
        return new static(array_pad($this->elements, $size, $value));
    }

    /**
     * Extract a slice of array
     *
     * @param int $offset Offset value of array
     * @param int|null $length Length of sliced array
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return static The new instance with sliced elements
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        return new static(array_slice($this->elements, $offset, $length, $preserveKeys));
    }

    /**
     * Split array into chunks
     *
     * @param int $size Size of each chunk
     * @param bool $preserveKeys Whether array keys are preserved or no
     *
     * @return static The new instance with splitted elements
     */
    public function chunk($size, $preserveKeys = false)
    {
        return new static(array_chunk($this->elements, $size, $preserveKeys));
    }

    /**
     * Removes duplicate values from array
     *
     * @param int|null $sortFlags
     *
     * @return static The new instance with unique elements
     */
    public function unique($sortFlags = null)
    {
        return new static(array_unique($this->elements, $sortFlags));
    }

    /**
     * Merges array with given one
     *
     * @param array $array Array for merge
     * @param bool $recursively Whether array will be merged recursively or no
     *
     * @return static The new instance with merged elements
     */
    public function mergeWith(array $array, $recursively = false)
    {
        if (true === $recursively) {
            return new static(array_merge_recursive($this->elements, $array));
        }

        return new static(array_merge($this->elements, $array));
    }

    /**
     * Merges array to given one
     *
     * @param array $array Array for merge
     * @param bool $recursively Whether array will be merged recursively or no
     *
     * @return static The new instance with merged elements
     */
    public function mergeTo(array $array, $recursively = false)
    {
        if (true === $recursively) {
            return new static(array_merge_recursive($array, $this->elements));
        }

        return new static(array_merge($array, $this->elements));
    }

    /**
     * Replace array with given one
     *
     * @param array $array Array for replace
     * @param bool $recursively Whether array will be replaced recursively or no
     *
     * @return static The new instance with replaced elements
     */
    public function replaceWith(array $array, $recursively = false)
    {
        if (true === $recursively) {
            return new static(array_replace_recursive($this->elements, $array));
        }

        return new static(array_replace($this->elements, $array));
    }

    /**
     * Replace array in given one
     *
     * @param array $array Array for replace
     * @param bool $recursively Whether array will be replaced recursively or no
     *
     * @return static The new instance with replaced elements
     */
    public function replaceIn(array $array, $recursively = false)
    {
        if (true === $recursively) {
            return new static(array_replace_recursive($array, $this->elements));
        }

        return new static(array_replace($array, $this->elements));
    }

    /**
     * Combine array values used as keys with a given array values
     *
     * @param array $array Array for combining
     *
     * @return static The new instance with combined elements
     */
    public function combineWith(array $array)
    {
        return new static(array_combine($this->elements, $array));
    }

    /**
     * Combine array values to a given array values used as keys
     *
     * @param array $array Array for combining
     *
     * @return static The new instance with combined elements
     */
    public function combineTo(array $array)
    {
        return new static(array_combine($array, $this->elements));
    }

    /**
     * Compute the difference of array with given one
     *
     * @param array $array Array for diff
     *
     * @return static The new instance containing all the entries from array that are not present in given one
     */
    public function diffWith(array $array)
    {
        return new static(array_diff($this->elements, $array));
    }

    /**
     * Shuffle array
     *
     * @return static The new instance with shuffled elements
     */
    public function shuffle()
    {
        $elements = $this->elements;

        shuffle($elements);

        return new static($elements);
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
        $elements = $this->elements;
        parent::sorting($elements, $order, $strategy, $preserveKeys);

        return new static($elements);
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.ksort.php
     * @link http://php.net/manual/en/function.krsort.php
     */
    public function sortKeys($order = SORT_ASC, $strategy = SORT_REGULAR)
    {
        $elements = $this->elements;
        parent::sortingKeys($elements, $order, $strategy);

        return new static($elements);
    }

    /**
     * Apply the given function to the array elements
     *
     * @param Closure $func
     *
     * @return static The new instance with modified elements
     */
    public function map(Closure $func)
    {
        return new static(array_map($func, $this->elements));
    }

    /**
     * Filter array elements with given function
     *
     * @param Closure $func
     *
     * @return static The new instance with filtered elements
     */
    public function filter(Closure $func)
    {
        return new static(array_filter($this->elements, $func));
    }

    /**
     * Apply the given function to every array element
     *
     * @param Closure $func
     * @param bool $recursively Whether array will be walked recursively or no
     *
     * @return static The new instance with modified elements
     */
    public function walk(Closure $func, $recursively = false)
    {
        $elements = $this->elements;

        if (true === $recursively) {
            array_walk_recursive($elements, $func);
        } else {
            array_walk($elements, $func);
        }

        return new static($elements);
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.usort.php
     */
    public function customSort(Closure $func)
    {
        $elements = $this->elements;

        usort($elements, $func);

        return new static($elements);
    }

    /**
     * {@inheritdoc}
     *
     * @link http://php.net/manual/en/function.uksort.php
     */
    public function customSortKeys(Closure $func)
    {
        $elements = $this->elements;

        uksort($elements, $func);

        return new static($elements);
    }

    /**
     * Clear array
     *
     * @return static The new instance with cleared elements
     */
    public function clear()
    {
        return new static();
    }
}
