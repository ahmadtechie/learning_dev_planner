<?php

// Include the Faker library autoload file
require_once 'vendor/autoload.php';

// Use the Faker\Factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

// Define the number of fake employees you want to generate
$numEmployees = 100;

// Define an array to store the generated employees
$employees = [];

// Generate fake employee data
for ($i = 0; $i < $numEmployees; $i++) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $email = $faker->unique()->safeEmail; // Ensure unique email
    $job = $faker->jobTitle;
    $department = $faker->word;
    $unit = $faker->word;
    $lineManagerId = $faker->randomNumber(2); // Assuming line manager IDs are numeric

    // Add the generated employee data to the array
    $employees[] = [
        'email' => $email,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'job' => $job,
        'department' => $department,
        'unit' => $unit,
        'line_manager_id' => $lineManagerId,
    ];
}

// Output the generated employees to a CSV file
$filename = 'fake_employees.csv';
$fp = fopen($filename, 'w');

// Write the CSV header
fputcsv($fp, array_keys($employees[0]));

// Write the employee data
foreach ($employees as $employee) {
    fputcsv($fp, $employee);
}

// Close the file pointer
fclose($fp);

echo "Fake employees generated and saved to $filename\n";
