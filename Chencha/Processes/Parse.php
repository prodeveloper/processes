<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 30/03/15
 * Time: 13:50
 */

namespace Chencha\Processes;


use Chencha\Conveyor;
use Chencha\Conveyor\Subject;
use Chencha\Processes\Process;
use DI\Container;
use DI\ContainerBuilder;

class Parse
{
    protected $container;

    function __construct(Container $container = null)
    {
        if (is_null($container)) {
            $builder = new ContainerBuilder();
            $container = $builder->build();
        }
        $this->container = $container;
    }

    function run(Subject $subject, array $processArray)
    {
        $process = new Process();
        foreach ($processArray['belts'][0] as $belt) {
            $belt_d = new Belt();
            foreach ($belt as $machine) {
                $belt_d->registerMachines($this->container->get($machine));
            }
            $process->registerBelts($belt_d);
        }

        $mainConveyor = new Conveyor();
        $process = $mainConveyor->buildProcess($process);
        $process->run($subject);
        return $process;

    }
}