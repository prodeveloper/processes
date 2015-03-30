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
class Parse
{
    function run(Subject $subject,array $processArray)
    {
        $process = new Process();
        foreach ($processArray['belts'][0] as $belt) {
            $belt_d = new Belt();
            foreach ($belt as $machine) {
                $belt_d->registerMachines(new $machine);
            }
            $process->registerBelts($belt_d);
        }

        $mainConveyor = new Conveyor();
        $process = $mainConveyor->buildProcess($process);
        $process->run($subject);
        return $process;

    }
}