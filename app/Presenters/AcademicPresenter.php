<?php

namespace ManagerProject\Presenters;

use ManagerProject\Transformers\AcademicTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AcademicPresenter
 *
 * @package namespace ManagerProject\Presenters;
 */
class AcademicPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AcademicTransformer();
    }
}
