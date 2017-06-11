<?php namespace Remoblaser\Resourceful\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class ExtendRoutesWithResourceCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = "route:extend";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Extend your routes with a resource";

    /**
     * @var mixed
     */
    protected $files;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function fire()
    {
        $name = $this->argument('name');

        $routes = $this->files->get($this->getPath());

        $stub = $this->files->get(__DIR__ . '/../stubs/route.stub');

        $filledStub = str_replace('{{resource}}', strtolower($name), $stub);
        $filledStub = str_replace('{{controller}}', $this->getControllerName($name), $filledStub);

        $routes .= $filledStub;

        $this->files->put($this->getPath(), $routes);

        $this->info('Routes successfully extended.');

    }

    /**
     * @param $resource
     */
    protected function getControllerName($resource)
    {
        return ucfirst($resource) . 'Controller';
    }

    protected function getPath()
    {
        return './routes/web.php';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the Resource'],
        ];
    }
}
