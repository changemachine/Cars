<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cartype.php";

    session_start();

    if (empty($_SESSION['list_of_cars'])){
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('cars.twig');
        }); //OFFLOADS HTML HOME/FORMS ONTO TWIG


    $app->get("/results", function() use ($app){
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

        //IN PROGRESS... watch the order on those attributes versus the form input order
  //   $app->post("/cars", function() {
  //     $car = new Car($_POST['type_car, value_car, miles_car, image_car']);
  //     $task->save();
  //     return "
  //         <h1>You created a task!</h1>
  //         <p>" . $task->getDescription() . "</p>
  //         <p><a href='/'>View your list of things to do.</a></p>
  //     ";
  // });
       //return $app['twig']->render('results.twig', array('showcars' => $output));
       return $app['twig']->render('results.twig', array('showcars' => $cars_matching_search));
    });
    return $app;

?>
