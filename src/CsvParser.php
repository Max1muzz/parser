<?php

// Require the ParserInterface and the Product class
require_once 'ParserInterface.php';
require_once 'Product.php';

// Define the CsvParser class that implements the ParserInterface for csv files
class CsvParser implements ParserInterface
{
    // Define a property to store the file name
    private $file;

    // Define a constructor that takes a file name as a parameter
    public function __construct($file)
    {
        // Set the file property to the file name
        $this->file = $file;
    }

    // Define a method that parses the csv file and returns an array of product objects
    public function parse($separator)
    {
        // Initialize an empty array to store the product objects
        $products = [];

        // Open the csv file for reading
        $handle = fopen($this->file, 'r');

        // Get the first row of the csv file as an array of headings
        $headings = fgetcsv($handle, 1000, $separator);

        //var_dump($headings);
        // Loop through the remaining rows of the csv file
        while ($row = fgetcsv($handle, 1000, $separator)) {
            // Initialize an empty associative array to store the product data
            $data = [];
            //var_dump($row);
            // Loop through each heading and assign its value from the row to the data array
            foreach ($headings as $index => $heading) {
                $data[$heading] = $row[$index];
            }
            // Create a new product object from the data array and add it to the products array
            $products[] = new Product($data);
        }

        // Close the csv file
        fclose($handle);
        
        // Return the products array
        return $products;
    }
}
?>
