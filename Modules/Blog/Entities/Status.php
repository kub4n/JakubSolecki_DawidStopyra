<?php

namespace Modules\Blog\Entities;

/**
 * Class Status
 * @package Modules\Blog\Entities
 */
class Status
{
    const DRAFT = 0;
    const PUBLISHED = 2;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DRAFT => trans('blog::status.draft'),
            self::PUBLISHED => trans('blog::status.published'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DRAFT];
    }
}
