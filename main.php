<?php
include_once "./File.php";
include_once "./Parking.php";

if (!isset($argv[1])) {
    echo "Invalid arguments passed - format:  /path/to/php main.php filename fileDir ";
    exit();
}

$fileDir = $argv[2]; //"";
$filename = $argv[1]; //"input.txt";

if (!file_exists($fileDir . $filename)) {
    echo "Input file not found in path " . $fileDir . $filename;
    exit();
}

$file = new File($filename, $fileDir);
$command_list = $file->getCommandList();

$parking = new Parking();
foreach ($command_list as $index => $command) {

    switch (parseCommand($command)) {

        case "1":

            list($com, $lot_size) = explode(" ", $command);
            $parking->createParkingLot($lot_size);
            echo "Created Parking of " . $lot_size . " slots";
            break;

        case "2":

            list($com, $vehicle_number, $dr_age, $age) = explode(" ", $command);
            $slot = $parking->park();
            $driver_age = $parking->setVehiclesSlotsofAge($age, $vehicle_number, $slot);
            $vehicle_slots = $parking->setVehiclesSlot($vehicle_number, $slot);

            if ($slot !== -1 && $slot !== 0) {
                echo "
                Car with vehicle registration number " . $vehicle_number . " has been parked at slot number " . $slot;
            } elseif ($slot === 0) {
                echo "Failed to park vehicle: Create a parking lot ";
            } else {
                echo "All slots are full";
            }
            break;

        case "3":

            list($com, $age) = explode(" ", $command);
            $slots = $parking->getSlotsFromAge($age);
            echo $slots != "" && $slots !== -1 ? implode(",", $slots) : "null";
            break;

        case "4":

            list($com, $vehicle_number) = explode(" ", $command);
            $slot = $parking->getSlotOfVehicle($vehicle_number);
            echo $slot !== -1 ? $slot : "null";
            break;

        case "5":

            list($com, $age) = explode(" ", $command);
            $vehicle_numbers = $parking->getVehiclesNumbersFromAge($age);
            echo $vehicle_numbers != "" ? implode(",  ", $vehicle_numbers) : "null";
            break;

        case "6":

            list($com, $leaving_slot) = explode(" ", $command);
            $vehicle_left = $parking->leaveSlot($leaving_slot);
            if ($vehicle_left["st_code"] == -1) {
                echo "Invalid leave slot";
                break;
            }
            echo $vehicle_left["st_code"] == 1 ? "
            Slot number " . $leaving_slot . " vacated, the car with vehicle number " . $vehicle_left["vehicle"] . " left the space, the driver of the car was of age " . $vehicle_left["age"] : "Slot already vacant";
            break;

        default:
            echo "Command doesn't match : " . $command;
    }
    echo "<br/>";
    echo "" . PHP_EOL;
}

function parseCommand($command)
{
    if (startsWith($command, "Create_parking_lot")) {
        return "1";
    }
    if (startsWith($command, "Park")) {
        return "2";
    }
    if (startsWith($command, "Slot_numbers_for_driver_of_age")) {
        return "3";
    }
    if (startsWith($command, "Slot_number_for_car_with_number")) {
        return "4";
    }
    if (startsWith($command, "Vehicle_registration_number_for_driver_of_age")) {
        return "5";
    }
    if (startsWith($command, "Leave")) {
        return "6";
    }

}

function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
