<?php

    class Restaurant
    {
        private $restaurant_name;
        private $id;

        function __construct($restaurant_name, $id = null)
        {
            $this->restaurant_name = $restaurant_name;
            $this->id = $id;
        }

        function getRestaurantName()
        {
            return $this->restaurant_name;
        }

        function setRestaurantName($new_restaurant_name)
        {
            $this->restaurant_name = $new_restaurant_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            // $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name) VALUES ('{$this->getRestaurantName()}');");

           $GLOBALS['DB']->exec("INSERT INTO restaurants(restaurant_name) VALUES ('{$this->getRestaurantName()}')");

           $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_restaurant_name)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET restaurant_name = '$new_restaurant_name' WHERE id = {$this->getId()}");
            $this->setRestaurantName($new_restaurant_name);
        }


        static function getAll()
        {
            $returned_restaurant_names = $GLOBALS['DB']->query('SELECT * FROM restaurants;');

            $restaurants = array();
            foreach($returned_restaurant_names as $name){
                $new_restaurant_name = $name['restaurant_name'];
                $new_id = $name['id'];
                $new_restaurant_object = new Restaurant($new_restaurant_name, $new_id);
                array_push($restaurants, $new_restaurant_object);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        // function setRestaurant_name($new_restaurant_name)
        // {
        //     $this->restaurant_name = $new_restaurant_name;
        // }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant){
                $restaurant_id = $restaurant->getId();
                if($restaurant_id == $search_id){
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
        }


    }
