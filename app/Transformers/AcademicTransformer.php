<?php

namespace ManagerProject\Transformers;

use League\Fractal\TransformerAbstract;
use ManagerProject\Entities\Academic;

/**
 * Class AcademicTransformer
 * @package namespace ManagerProject\Transformers;
 */
class AcademicTransformer extends TransformerAbstract
{

    /**
     * Transform the \Academic entity
     * @param \Academic $model
     *
     * @return array
     */
    public function transform(Academic $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
