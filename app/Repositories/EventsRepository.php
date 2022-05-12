<?php

namespace App\Repositories;

use App\Models\Event;

class EventsRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'title',
        'date',
        'location',
        'detail',
        'from',
        'to',
        'registration_link',
        'created_by',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Event::class;
    }
}
