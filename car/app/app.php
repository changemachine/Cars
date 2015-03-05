<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cartype.php";

    $app = new Silex\Application();


    $app->get("/", function(){
        return "
        <!DOCTYPE html>
            <html>
            <head>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' type='text/css'>
                <title>Find a Car</title>
            </head>
            <body>
                <div class='container'>
                    <h1>Find a Car!</h1>
                    <form action='/view_car'>
                        <div class='form-group'>
                            <label for='price'>Enter Maximum Price:</label>
                            <input id='price' name='price' class='form-control' type='number'>
                            <label for='mileage'>Enter Max Miles:</label>
                            <input id='mileage' name='mileage' class='form-control' type='number'>
                        </div>

                        <button type='submit' class='btn-success'>Submit</button>
                    </form>
                </div>
            </body>
            </html>
            ";
        });



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
        }

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


        return  "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Your Car Dealership's Homepage</title>
        </head>
        <body>
            <h1>Your Car Dealership</h1>
            <ul>
            $output
            </ul>

                </body>
                </html>
                ";

            });


    return $app;

?>
