<?php

class Parking
{
    public $parking_lot;
    public $driver_age;
    public $vehicle_slot;
    public function __construct()
    {
        $this->parking_lot = [];
        $this->driver_age = [];
        $this->vehicle_slot = [];
    }

    public function isValidPrakingLot()
    {
        return count($this->parking_lot) === 0 ? false : true;
    }

    public function createParkingLot($lot_size)
    {
        $this->parking_lot = range(1, $lot_size);
    }

    public function park()
    {
        if (!$this->isValidPrakingLot()) {
            return 0;
        }
        $index = $this->getParkingSlot();
        $slot = $this->parking_lot[$index];
        if ($slot > 0) {
            $this->parking_lot[$index] = 0;
            return $slot;
        }
        return -1;
    }
    public function getParkingSlot()
    {
        if ($this->checkForEmptySlot()) {
            foreach ($this->parking_lot as $index => $slot) {
                if ($slot !== 0) {
                    return $index;
                }
            }
        } else {
            return -1;
        }
    }
    public function checkForEmptySlot()
    {
        return count(array_unique($this->parking_lot)) !== 1;
    }

    public function getParkingLot()
    {
        return $this->parking_lot;
    }

    public function setVehiclesSlotsofAge($age, $vehicle_number, $slot)
    {
        if (!array_key_exists($age, $this->driver_age)) {
            $this->driver_age[$age] = array("slots" => array(), "vehicles" => array());
        }
        array_push($this->driver_age[$age]["slots"], $slot);
        array_push($this->driver_age[$age]["vehicles"], $vehicle_number);
        return $this->driver_age;
    }
    public function setVehiclesSlot($vehicle_number, $slot)
    {
        $this->vehicle_slot[$vehicle_number] = $slot;
        return $this->vehicle_slot;
    }

    public function getSlotsFromAge($age)
    {
        return $this->isValidPrakingLot() === true ? $this->driver_age[$age]["slots"] : -1;
    }

    public function getVehiclesNumbersFromAge($age)
    {
        return $this->driver_age[$age]["vehicles"];
    }

    public function getSlotOfVehicle($vehicle_number)
    {
        return $this->isValidPrakingLot() === true ? $this->vehicle_slot[$vehicle_number] : -1;
    }

    public function leaveSlot($slot)
    {
        $temp = array("slot" => $slot, "vehicle" => "", "age" => "", "st_code" => 2);
        if (!$this->isValidPrakingLot() || $slot > count($this->parking_lot)) {
            $temp["st_code"] = -1;
            return $temp;
        }

        if ($this->parking_lot[$slot - 1] == 0) {
            $temp["st_code"] = 1;
            $this->parking_lot[$slot - 1] = $slot;
        }
        foreach ($this->driver_age as $age => $value) {
            if (in_array($slot, $value["slots"])) {
                $index = array_search($slot, $value["slots"]);
                $temp["vehicle"] = $value["vehicles"][$index];
                $temp["age"] = $age;
            }
        }
        return $temp;
    }
}
