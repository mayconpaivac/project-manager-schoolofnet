<?php

namespace ManagerProject\Presenters;


use ManagerProject\Transformers\ProjectNoteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectNotePresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectNoteTransformer();
    }
}