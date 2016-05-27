<?php

namespace ManagerProject\Presenters;


use ManagerProject\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new UserTransformer();
    }
}