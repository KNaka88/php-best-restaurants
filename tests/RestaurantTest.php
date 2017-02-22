<?php


///Test 0: test_getName
    //Desc: check class Restaurant is made and can call name by getName()
    //Input: "Sam's Pizza"
    //Output: "Sam's Pizza"

////Test 1: test_save
        //We need to create and test
        //save()
        //getAll()
        //Desc: add restaurant_name restaurant table and return
        //Input: "Sam's Pizza"
        //Output: "Sam's Pizza"

///Test 2: test_deleteAll()    *don't forget tearDown!!
        //We need
        //deleteAll()
        //Desc: delete all records from restaurant_name
        //Input: "Sam's Pizza", "Tom's Burgers"
        //Output: " "

///Test 3: test_getId()   *update save(), getAll() func
        //use getId()
        //desc: return hard-coded value
        //Input: restaurant_name = "Bob's Burgers", id = 1
        //Output: 1

///Test 4 test_find()
        //We need
        //find()
        //desc: find all matched indexes to restaurant_names
        //Input restaurant_name1 = "Sam's Pizza, 1", restaurant_name2 = "Tom's Burgers, 2"
        //output: "Sam's Pizza, Tom's Burgers"
