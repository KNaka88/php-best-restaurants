<?php

    class Cuisine
    {
        private $cuisine_type;
        private $id;

        function __construct($cuisine_type, $id = null)
        {
            $this->cuisine_type = $cuisine_type;
            $this->id = $id;
        }

        function getCuisineType()
        {
            return $this->cuisine_type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            // $GLOBALS['DB']->exec("INSERT INTO cuisine (cuisine_type) VALUES ('{$this->getCuisineName()}');");

           $GLOBALS['DB']->exec("INSERT INTO cuisine(cuisine_type) VALUES ('{$this->getCuisineType()}')");

           $this->id = $GLOBALS['DB']->lastInsertId();
        }


        static function getAll()
        {
            $returned_cuisine_types = $GLOBALS['DB']->query('SELECT * FROM cuisine;');

            $cuisine = array();
            foreach($returned_cuisine_types as $name){
                $new_cuisine_type = $name['cuisine_type'];
                $new_id = $name['id'];
                $new_cuisine_object = new Cuisine($new_cuisine_type, $new_id);
                array_push($cuisine, $new_cuisine_object);
            }
            return $cuisine;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisine;");
        }

        // function setCuisine_name($new_cuisine_type)
        // {
        //     $this->cuisine_type = $new_cuisine_type;
        // }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine){
                $cuisine_id = $cuisine->getId();
                if($cuisine_id == $search_id){
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }


    }
