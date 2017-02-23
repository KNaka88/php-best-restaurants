<?php


    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $server = 'mysql:host=localhost:8889;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\Debug\Debug;

    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(
       new Silex\Provider\TwigServiceProvider(),
       array('twig.path' => __DIR__.'/../views')
    );

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisine", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll() ));
    });

    $app->get("/restaurant/{id}", function($id) use ($app) {
        $cuisine_id = $id;
        //return all Restaurant with  specific cuisine_id;
        //return cuisine_id??
        return $app['twig']->render('restaurant.html.twig', array('restaurants' => Restaurant::getMatch($id), 'cuisine' => Cuisine::getAll(), 'cuisine_id'=> $cuisine_id));
    });

    $app->post("/addrestaurant", function() use ($app) {
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($_POST['restaurant'], $_POST['cuisine_id']);
        var_dump($restaurant);
        $restaurant->save();
        return $app['twig']->render('restaurant.html.twig', array('restaurants' => Restaurant::getMatch($cuisine_id), 'cuisine_id'=> $cuisine_id));
    });

    $app->get("/editrestaurant/{id}", function($id) use ($app) {
        $find_restaurant = Restaurant::find($id);
        return $app['twig']->render('edit-restaurant.html.twig', array('editrestaurant' => $find_restaurant));
    });

    $app->patch("/updaterestaurant/{id}", function($id) use ($app) {
        $restaurant_name = Restaurant::find($id);
        $update_restaurant = $_POST['update'];
        $restaurant_name->update($update_restaurant);
        return $app['twig']->render('restaurant.html.twig', array('restaurants' => Restaurant::getAll(), 'cuisine' => Cuisine::getAll()));
    });

    $app->get('/deleterestaurant/{id}', function($id) use ($app) {
        $find_restaurant = Restaurant::find($id);
        $find_restaurant->delete();
        return $app['twig']->render('restaurant.html.twig', array('restaurants' => Restaurant::getAll()));
    });


    return $app;
