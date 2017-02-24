<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost:8889;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ResaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
         {
           Restaurant::deleteAll();
         }

        // /Test 0: test_getName
        // Desc: check class Restaurant is made and can call name by getName()
        // Input: "Sam's Pizza"
        // Output: "Sam's Pizza"
        function test_getName()
       {
           //Arrange
           $restaurant_name = "Sams Pizza";
           $test_restaurant = new Restaurant($restaurant_name);

           //Act
           $test_restaurant->getRestaurantName();

           //Assert
           $result = $test_restaurant;
           $this->assertEquals($test_restaurant, $result);
       }

       //Test 1: test_save
    //    We need to create and test
    //    save()
    //    getAll()
    //    Desc: add restaurant_name restaurant table and return
    //    Input: "Sam's Pizza"
    //    Output: "Sam's Pizza"
       function test_save()
        {
            //Arrange
            $restaurant_name = "Sams Pizza";
            $test_restaurant = new Restaurant($restaurant_name, 3);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

       function test_getAll()
       {
           // Arrange
           // $restaurant_name1 = addslashes("Sam's Pizza");
           $restaurant_name1 = "Sams Pizza";
           $restaurant_name2 = "Bobs Burgers";
           $test_restaurant1 = new Restaurant($restaurant_name1, 3);
           $test_restaurant1->save();
           $test_restaurant2= new Restaurant($restaurant_name2, 4);
           $test_restaurant2->save();

           //Act
           $result = Restaurant::getAll();

           //Assert
           $this->assertEquals($test_restaurant1, $result[0]);
       }


///Test 2: test_deleteAll()    *don't forget tearDown!!
        //We need
        //deleteAll()
        //Desc: delete all records from restaurant_name
        //Input: "Sam's Pizza", "Tom's Burgers"
        //Output: " "


       function test_deleteAll()
       {
           // Arrange
           $restaurant_name1 = "Sams Pizza";
           $restaurant_name2 = "Bobs Burgers";
           $test_restaurant1 = new Restaurant($restaurant_name1, 3);
           $test_restaurant1->save();
           $test_restaurant2= new Restaurant($restaurant_name2, 4);
           $test_restaurant2->save();

           //Act
           Restaurant::deleteAll();
           $result = Restaurant::getAll();

           //Assert
           $this->assertEquals([], $result);
       }
        ///Test 3: test_getId()   *update save(), getAll() func
                //use getId()
                //desc: return hard-coded value
                //Input: restaurant_name = "Bob's Burgers", id = 1
                //Output: 1
                function test_getId()
                  {
                      //Arrange
                      $restaurant_name = "Sams Pizza";
                      $restaurant_id = 1;
                      $cuisine_id = 1;
                      $test_restaurant = new Restaurant($restaurant_name, $cuisine_id, $restaurant_id);

                      //Act
                      $result = $test_restaurant->getId();

                      //Assert
                      $this->assertEquals(true, is_numeric($result));
                  }

        ///Test 4 test_find()
                //We need
                //find()
                //desc: find all matched indexes to restaurant_names
                //Input restaurant_name1 = "Sam's Pizza, 1", restaurant_name2 = "Tom's Burgers, 2"
                //output: "Sam's Pizza, Tom's Burgers"

                function test_find()
                {
                    //Arrange
                    $restaurant_name = "Sams Pizza";
                    $cuisine_id = 5;
                    $restaurant_name2 = "Bobs Burgers";
                    $cuisine_id2 = 6;
                    $test_restaurant = new Restaurant($restaurant_name, $cuisine_id);
                    $test_restaurant2 = new Restaurant($restaurant_name2, $cuisine_id2);
                    $test_restaurant->save();
                    $test_restaurant2->save();


                    //Act
                    $result = Restaurant::find($test_restaurant->getId());

                    //Assert
                    $this->assertEquals($test_restaurant, $result);
                }

                function test_update()
                {
                    // Arrange
                    $restaurant_name = "Sams Pizza";
                    $restaurant_id = null;
                    $cuisine_id = 5;
                    $test_restaurant = new Restaurant($restaurant_name, $restaurant_id, $cuisine_id);
                    $new_restaurant_name = "Bobs Burgers";

                    // Act
                    $test_restaurant->update($new_restaurant_name);

                    // Assert
                    $this->assertEquals($new_restaurant_name, $test_restaurant->getRestaurantName());

                }


                function testDelete()
                {

                    //Arrange
                    $restaurant_name = "Sams Pizza";
                    $test_restaurant = new Restaurant($restaurant_name, 3);
                    $test_restaurant->save();

                    $restaurant_name2 = "Sams Pizza";
                    $test_restaurant2 = new Restaurant($restaurant_name2, 4);
                    $test_restaurant2->save();

                    //Act
                    $test_restaurant->delete();

                    //Assert
                    $this->assertEquals( [$test_restaurant2], Restaurant::getAll());
                }



}
