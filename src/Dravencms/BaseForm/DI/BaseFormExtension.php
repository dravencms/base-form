<?php declare(strict_types = 1);

namespace Dravencms\BaseForm\DI;

use Nette\DI\CompilerExtension;

/**
 * Class BaseGridExtension
 * @package Dravencms\BaseGrid\DI
 */
class BaseFormExtension extends CompilerExtension
{
    public function loadConfiguration(): void
    {
        // Applications may use a different translator or provide catalogs themselves.
        foreach ($this->compiler->getExtensions(\Contributte\Translation\DI\TranslationExtension::class) as $extension) {
            $config = $extension->getConfig();
            $config['dirs'][] = __DIR__ . '/../lang';
            $extension->setConfig($config);
        }
        $this->loadModels();
    }

    public function beforeCompile(): void
    {
        $builder = $this->getContainerBuilder();
        $application = $builder->getByType(\Nette\Application\Application::class);
        if ($application === null) { return; }
        $builder->addDefinition($this->prefix('formSession'))->setFactory(\Dravencms\BaseForm\FormSession::class);
        $builder->getDefinition($application)->addSetup('$onResponse[]', [[$this->prefix('@formSession'), 'prepare']]);
    }

    protected function loadModels(): void
    {
        $builder = $this->getContainerBuilder();
        foreach ($this->loadFromFile(__DIR__ . '/models.neon') as $i => $command) {
            $cli = $builder->addDefinition($this->prefix('models.' . $i));
            if (is_string($command)) {
                $cli->setFactory($command);
            } else {
                throw new \InvalidArgumentException;
            }
        }
    }
}
