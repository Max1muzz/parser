<?php

// Define the ParserInterface that declares the methods for parsing different file formats
interface ParserInterface
{
    // Define a constructor that takes a file name as a parameter
    public function __construct($file);

    // Define a method that parses the file and returns an array of product objects
    public function parse($separator);
}
?>