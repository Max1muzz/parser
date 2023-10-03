<?php

// Define the Product class
class Product
{
    // Define the product properties
    public $make;
    public $model;
    public $colour;
    public $capacity;
    public $network;
    public $grade;
    public $condition;

    // Define the constructor that takes an associative array of product data
    public function __construct($data)
    {
        // Set the product properties from the data array
        // If a required property is missing, throw an exception
        if (isset($data['brand_name'])) {
            $this->make = $data['brand_name'];
        } else {
            throw new Exception("Missing make property");
        }
        if (isset($data['model_name'])) {
            $this->model = $data['model_name'];
        } else {
            throw new Exception("Missing model property");
        }
        if (isset($data['colour_name'])) {
            $this->colour =  $data['colour_name'];
        }
        if (isset($data['gb_spec_name'])) {
            $this->capacity = $data['gb_spec_name'];
        }
        if (isset($data['network_name'])) {
            $this->network = $data['network_name'];
        }
        if (isset($data['grade_name'])) {
            $this->grade =  $data['grade_name'];
        }
        if (isset($data['condition_name'])) {
            $this->condition = $data['condition_name'];
        }
    }

    // Define a method that returns a unique combination key for the product object
    public function getCombinationKey()
    {
        // Use a comma-separated string of the product properties as the key
        return implode(',', [
            'make: ' . $this->make,
            'model: ' . $this->model,
            'colour: ' . $this->colour,
            'capacity: ' . $this->capacity,
            'network: ' . $this->network,
            'grade: ' . $this->grade,
            'condition: ' . $this->condition
        ]);
    }
}
?>
