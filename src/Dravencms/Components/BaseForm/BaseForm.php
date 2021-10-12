<?php declare(strict_types = 1);

namespace Dravencms\Components\BaseForm;

use Dravencms\Components\BaseControl\BaseControl;
use Nette\Forms\FormRenderer;
use Nette\Application\UI\Form;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class BaseForm extends BaseControl implements BaseFormFactory
{
    /** @var FormRenderer|null */
    private $renderer;


    /**
     * BaseForm constructor.
     * @param FormRenderer|null $renderer
     */
    public function __construct(FormRenderer $renderer = null)
    {
        $this->renderer = $renderer;
    }


    /**
     * @return Form
     */
    public function create(): Form
    {
        $form = new Form();
        $form->setRenderer($this->renderer);
        $form->addProtection('Please, send form again.');

        return $form;
    }

}