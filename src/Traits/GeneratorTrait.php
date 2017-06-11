<?php namespace Remoblaser\Resourceful\Traits;

trait GeneratorTrait
{

    protected function generateMigration()
    {

        if ($this->schema()) {
            $this->call('make:migration:schema', [
                'name' => $this->migrationName(),
                '--schema' => $this->schema(),
            ]);
        } else {
            $this->call('make:migration', [
                'name' => $this->migrationName(),
            ]);
        }
    }

    protected function generateSeed()
    {
        $this->call('make:seed', [
            'name' => $this->name(),
        ]);
    }

    protected function generateModel()
    {
        $this->call('make:model', [
            'name' => ucfirst(str_singular($this->name())),
        ]);
    }

    protected function generateController()
    {
        $name = $this->argument('name');
        $commands = $this->option('commands');

        $this->call('make:request', [
            'name' => $this->requestName(str_singular($name)),
        ]);

        $bind = $this->option('bind');

        $this->call('make:resource:controller', [
            'name' => $name,
            '--commands' => $commands,
            '--bind' => $bind,
        ]);
    }

    protected function generateViews()
    {
        $name = $this->argument('name');
        $commands = $this->option('commands');

        if ($commands) {
            $this->call('make:resource:views', [
                'name' => $name,
                '--commands' => $commands,
            ]);
        } else {
            $this->call('make:resource:views', [
                'name' => $name,
            ]);
        }
    }

    /**
     * @param $name
     */
    protected function requestName($name)
    {
        return ucfirst($name) . "Request";
    }
}
