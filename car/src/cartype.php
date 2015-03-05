<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    public $image;

    function worthBuying($max_price, $max_mileage) {
        return $this->price < $max_price && $this->miles < $max_mileage;
    }
    function __construct($type_car, $value_car, $miles_car, $image_car) {
        $this->make_model = $type_car;
        $this->price = $value_car;
        $this->miles = $miles_car;
        $this->image = $image_car;
    }
    function setMake_model($new_make){
        $string_model = (string) $new_make;
         if ($string_model != 0) {
             $this->make_model = $string_model;
         }
    }
    function setMiles($new_miles){
        $string_miles = (float) $new_miles;
        if ($float_miles != 0) {
            $this->miles = $float_miles;
        }
    }
    function setPrice($new_price){
        $float_price = (float) $new_price;
         if ($float_price != 0) {
            $this->price = $float_price;
         }
    }
    function getMake_model(){
        return $this->make_model;
    }
    function getMiles(){
        return $this->miles;
    }
    function getPrice()    {
        return $this->price;
    }
}

?>
