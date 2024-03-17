<?php declare(strict_types = 1);

namespace Dravencms\Components\BaseForm;

use Dravencms\Components\BaseControl\BaseControl;
use Nette\Localization\Translator;
use Nette\Forms\FormRenderer;


/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class BaseFormFactory extends BaseControl
{
    /** @var FormRenderer|null */
    private $renderer;

    /** @var Translator */
    private $translator;

    /**
     * BaseForm constructor.
     * @param FormRenderer|null $renderer
     */
    public function __construct(Translator $translator, FormRenderer $renderer = null)
    {
        $this->renderer = $renderer;
        $this->translator = $translator;
    }


    /**
     * @return Form
     */
    public function create(): Form
    {
        $form = new Form();
        $form->setTranslator($this->translator);
        if ($this->renderer) {
            // renderer can be null but setRenderer only accepts FormRenderer
            $form->setRenderer($this->renderer);
        }
        
        $form->addProtection('Please, send form again.');

        return $form;
    }

}
