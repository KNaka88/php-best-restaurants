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

        function getRestaurant_name()
        {
            return $this->restaurant_name;
        }

        function getId()
        {
            return $this->id;
        }


        // function setRestaurant_name($new_restaurant_name)
        // {
        //     $this->restaurant_name = $new_restaurant_name;
        // }
    }
