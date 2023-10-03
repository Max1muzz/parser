# Supplier Product List Processor

This application parses CSV files and returns a Product object for each row. It also creates a file with a count of unique combinations of product properties.

## Requirements

- PHP 7+

## Usage

Run the following command in your terminal:
    php parser.php --file examples/`<parsing_file>` --unique-combinations results/`<result_file>`

Replace `<parsing_file>` with the name of the CSV file, and `<result_file>` with the name of the output file to count unique combinations.

## Notes

- New formats (json, xml, etc.) may be introduced in the future.
- You can change the delimiter(',' tab, etc) in the `parser.php` file in line #40.
- Mandatory fields (make and model) must be found in the file. Otherwise an exception will be thrown.
- If `<result_file>` does not exist, it will be automatically created. If it exists, it will be overwritten.
- Line #55 in `parser.php` prints each product object representation to the screen, this can be very long time. You can comment out this line and then everything will work the same way but without the output to the screen and much faster.
