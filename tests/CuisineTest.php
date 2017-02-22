<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
         {
           Cuisine::deleteAll();
         }

        ///Test 0: test_getName
        //Desc: check class Cuisine is made and can call name by getName()
        //Input: "Sam's Pizza"
        //Output: "Sam's Pizza"
        function test_getName()
       {
           //Arrange
           $cuisine_type = "American";
           $test_cuisine = new Cuisine($cuisine_type);

           //Act
           $test_cuisine->getCuisineType();

           //Assert
           $result = $test_cuisine;
           $this->assertEquals($test_cuisine, $result);
       }

       ////Test 1: test_save
       //We need to create and test
       //save()
       //getAll()
       //Desc: add cuisine_type restaurant table and return
       //Input: "Sam's Pizza"
       //Output: "Sam's Pizza"
       function test_save()
        {
            //Arrange
            $cuisine_type = "American";
            $test_cuisine = new Cuisine($cuisine_type);

            //Act
            $test_cuisine->save();

            //Assert
            $result = Cuisine::getAll();
            $this->assertEquals($test_cuisine, $result[0]);
        }

       function test_getAll()
       {
           // Arrange
           // $cuisine_type1 = addslashes("Sam's Pizza");
           $cuisine_type1 = "American";
           $cuisine_type2 = "Greek";
           $test_cuisine1 = new Cuisine($cuisine_type1);
           $test_cuisine1->save();
           $test_cuisine2= new Cuisine($cuisine_type2);
           $test_cuisine2->save();

           //Act
           $result = Cuisine::getAll();

           //Assert
           $this->assertEquals($test_cuisine1, $result[0]);
       }


///Test 2: test_deleteAll()    *don't forget tearDown!!
        //We need
        //deleteAll()
        //Desc: delete all records from cuisine_type
        //Input: "Sam's Pizza", "Tom's Burgers"
        //Output: " "


       function test_deleteAll()
       {
           // Arrange
           $cuisine_type1 = "American";
           $cuisine_type2 = "Greek";
           $test_cuisine1 = new Cuisine($cuisine_type1);
           $test_cuisine1->save();
           $test_cuisine2= new Cuisine($cuisine_type2);
           $test_cuisine2->save();

           //Act
           Cuisine::deleteAll();
           $result = Cuisine::getAll();

           //Assert
           $this->assertEquals([], $result);
       }
        ///Test 3: test_getId()   *update save(), getAll() func
                //use getId()
                //desc: return hard-coded value
                //Input: cuisine_type = "Bob's Burgers", id = 1
                //Output: 1
                function test_getId()
                  {
                      //Arrange
                      $cuisine_type = "American";
                      $cuisine_id = 1;
                      $test_cuisine = new Cuisine($cuisine_type, $cuisine_id);

                      //Act
                      $result = $test_cuisine->getId();

                      //Assert
                      $this->assertEquals(true, is_numeric($result));
                  }

        ///Test 4 test_find()
                //We need
                //find()
                //desc: find all matched indexes to cuisine_types
                //Input cuisine_type1 = "Sam's Pizza, 1", cuisine_type2 = "Tom's Burgers, 2"
                //output: "Sam's Pizza, Tom's Burgers"

                function test_find()
                {
                    //Arrange
                    $cuisine_type = "American";
                    $cuisine_type2 = "Greek";
                    $test_cuisine = new Cuisine($cuisine_type);
                    $test_cuisine2 = new Cuisine($cuisine_type2);
                    $test_cuisine->save();
                    $test_cuisine2->save();


                    //Act
                    $result = Cuisine::find($test_cuisine->getId());

                    //Assert
                    $this->assertEquals($test_cuisine, $result);
                }
}
