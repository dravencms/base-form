# DravenCMS Base Form

Shared Nette form factory used by DravenCMS administration components. It creates the package-specific `Form` class and applies the translator and common rendering setup in one place.

## Installation

```bash
composer require dravencms/base-form
```

The bundled configuration registers `Dravencms\BaseForm\DI\BaseFormExtension`. DravenCMS applications normally load it through the package metadata.

## Usage

Inject `BaseFormFactory` into a control and create the form inside the component factory method:

```php
use Dravencms\Components\BaseForm\BaseFormFactory;
use Dravencms\Components\BaseForm\Form;

final class ArticleForm
{
    public function __construct(
        private BaseFormFactory $baseFormFactory,
    ) {
    }

    protected function createComponentForm(): Form
    {
        $form = $this->baseFormFactory->create();
        $form->addText('title')->setRequired();
        $form->addSubmit('send');
        return $form;
    }
}
```

Set edit defaults on the local `$form` after its controls have been created. Do not access `$this['form']` from a component constructor, because the Nette component tree is not ready there.

## License

This package is licensed under the LGPL-3.0 license.
