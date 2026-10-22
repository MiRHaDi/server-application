<?php

namespace App\Services;

use Illuminate\Support\Str;
use LogicException;
use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Module;

class ModuleActivatorService implements ActivatorInterface
{
    public function enable(Module $module): void
    {
        $this->denyMutation();
    }

    public function disable(Module $module): void
    {
        $this->denyMutation();
    }

    public function hasStatus(Module $module, bool $status): bool
    {
        $name = Str::upper(Str::snake($module->getName()));
        $enabled = getenv("MODULE_BACKEND_{$name}_ENABLED") === 'true';

        return $enabled === $status;
    }

    public function setActive(Module $module, bool $active): void
    {
        $this->denyMutation();
    }

    public function setActiveByName(string $name, bool $active): void
    {
        $this->denyMutation();
    }

    public function delete(Module $module): void
    {
        $this->denyMutation();
    }

    public function reset(): void
    {
        $this->denyMutation();
    }

    private function denyMutation(): void
    {
        throw new LogicException('Module activation is read-only; configure MODULE_BACKEND_<NAME>_ENABLED and restart the container.');
    }
}
