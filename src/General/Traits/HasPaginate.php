<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 05.03.2019
 */

namespace KuzyT\Halfdream\General\Traits;


trait HasPaginate
{
    /**
     * @var int|null
     */
    protected $paginate = null;

    /**
     * @param int|null $paginate
     * @return $this
     */
    public function setPaginate($paginate)
    {
        $this->paginate = $paginate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPaginate()
    {
        return $this->paginate;
    }
}