<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 30/03/15
 * Time: 13:50
 */

namespace Chencha\Processes;


class Parse
{
    function run($subject, $processFileLocation)
    {
        $data = json_decode(file_get_contents($processFileLocation));
        $process = new \Chencha\Conveyor\Defaults\Process();
        foreach ($data->belts[0] as $belt) {
            $belt_d = new \Chencha\Conveyor\Defaults\Belt();
            foreach ($belt as $machine) {
                $belt_d->registerMachines(new $machine);
            }
            $process->registerBelts($belt_d);
        }

        $mainConveyor = new Chencha\Conveyor();
        $process = $mainConveyor->buildProcess($process);
        $process->run($subject);
        return $process;

    }
}