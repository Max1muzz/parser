<?php

// Get the arguments from the command line
$options = getopt("", ["file:", "unique-combinations:"]);

// Check if the arguments is provided and valid
if (isset($options['file']) && file_exists($options['file'])) {
    
    if (isset($options['unique-combinations'])) {
        $file = $options['file'];
        $combination_file = $options['unique-combinations'];
    } else {
        throw new Exception("Missing unique-combinations argument");
    }
} else {
    throw new Exception("Invalid file name or path");
}

// Get the file extension and require the corresponding parser class
$extension = pathinfo($file, PATHINFO_EXTENSION);

switch ($extension) {
    case 'csv':
        require_once 'src/CsvParser.php';
        $parser = new CsvParser($file);
        break;
    case 'json':
        require_once 'src/JsonParser.php';
        $parser = new JsonParser($file);
        break;
    case 'xml':
        require_once 'src/XmlParser.php';
        $parser = new XmlParser($file);
        break;
    default:
        throw new Exception("Unsupported file format");
}

 // Parse the file and get the product objects. 
//$products = $parser->parse("\t");
$products = $parser->parse(","); //YOU CAN CHANGE THE SEPARATOR HERE

// Create a file with a grouped count for each unique combination
$combinations = [];
foreach ($products as $product) {
    // Get the combination key from the product object
    $key = $product->getCombinationKey();
    // Increment the count for the combination or set it to 1 if not exists
    if (isset($combinations[$key])) {
        $combinations[$key]++;
    } else {
        $combinations[$key] = 1;
    }
    // Display each product object row by row
    var_dump($product);
}

// Open the combination file for writing
$handle = fopen($combination_file, 'w');
$i = 0;
// Write each combination and its count to the file
foreach ($combinations as $key => $count) {
    $i++;
    // Split the key by comma and get the product properties
    list($make, $model, $colour, $capacity, $network, $grade, $condition) = explode(',', $key);
    // Write the properties and the count to the file in a csv format
    fputcsv($handle, [$i, $make, $model, $colour, $capacity, $network, $grade, $condition, 'Count: ' . $count], "\n");
}
// Close the combination file
fclose($handle);
echo "Done\n";
exit;
?>