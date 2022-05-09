<?php

namespace App\Repositories;

use App\Models\Stream;

class StreamRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldsSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Stream::class;
    }
}
