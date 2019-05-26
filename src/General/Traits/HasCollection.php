<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 06.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Trait HasCollection
 * @package KuzyT\Halfdream\General\Traits
 */
trait HasCollection
{
    /**
     * @var \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    protected $collection;

    /**
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getCollection() {
        return $this->collection;
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator|array $collection
     * @return $this
     */
    public function setCollection($collection) {
        if (is_array($collection)) {
            $collection = collect($collection);
        }
        $this->collection = $collection;
        return $this;
    }

    /**
     * @param array $options
     *  * paginate => true|false
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function makeCollection($options = []) {
        // Special for class with HasModelClass Trait
        if (method_exists($this, 'getModelClass') && $this->getModelClass()) {
            $options = array_merge([
                'paginate' => true,
                'queryPrepare' => function($query) { return $query->orderBy('id', 'desc'); }
            ], $options);

            $query = $options['queryPrepare'](($this->getModelClass())::query());

            // Special for class with HasePaginate Trait
            if ($options['paginate'] && method_exists($this, 'getPaginate') && $this->getPaginate()) {
                // todo - at least add order changes
                return $query->paginate($this->getPaginate());
            } else {
                return $query->get();
            }
        }
        return collect();
    }

    /**
     * Making collection from model, for select or radio
     * todo - maybe move in other place? It looks weird here
     * @param string $model
     * @param string $value
     * @param string $key
     * @return $this
     */
    public function setCollectionModel($model, $value, $key = 'id') {
        if (method_exists($this, 'setModelClass')) {
            $this->setModelClass($model);
        }

        $this->setCollection($this->makeCollection()->pluck($value, $key));
        return $this;
    }
}
