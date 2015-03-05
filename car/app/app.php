<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cartype.php";

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app){
        return $app['twig']->render('cars.twig');
        }); //OFFLOADS HTML HOME/FORMS ONTO TWIG


    $app->get("/view_car", function(){
        $mercedes = new Car("Mercedes Benz CLS550",39900,37979,"images/mercedes.jpeg");
        $porsche = new Car("2004 Porsche 911",114991,7862,"images/porsche.jpeg");
        $ford = new Car("2011 Ford F450",55885,14241,"images/ford.jpeg");
        $lexus = new Car("2013 Lexus RX 350",44700,20000,"images/lexus.jpeg");
        $cars = array($ford, $porsche, $lexus, $mercedes);
        $cars_matching_search = array();

        foreach ($cars as $car) {
            if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
                array_push($cars_matching_search, $car);
            }
        } //INSTANCIATES CARS, CREATES ARRAY FOR SEARCH RESULTS, RUNS CARS THROUGH worthBuying() AND POPULATES $cars_matching... WINNERS

        $output = "";
        foreach ($cars_matching_search as $car) {
            $value = $car->getPrice();
            $miles = $car->getMiles();
            $make = $car->getMake_model();
            $output = $output . "<img src='$car->image'>" .
            "<ul>" . "<li> $make </li>" .
                "<li> $$value </li>" .
                 "<li> Miles: $miles </li>" .
             "</ul>";
        };

        if (empty($cars_matching_search)){
           echo "<h2>Sorry, no cars match your search at this time.</h2>";
       }

       return $output;

    return $app;

?>
