<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: POST");

try {
    // Database connection
    $connect = new PDO("mysql:host=127.0.0.1;dbname=login", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the 'registration' table if it doesn't exist
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS registration (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";
    $connect->exec($createTableQuery);

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get JSON input data
        $form_data = json_decode(file_get_contents('php://input'));

        // Prepare data for the query
        $data = array(
            ":email" => $form_data->email,
            ":password" => $form_data->password
        );

        // SQL query to insert data into the database
        $query = "INSERT INTO registration (email, password) VALUES (:email, :password)";
        $statement = $connect->prepare($query);
        
        // Execute the query
        if ($statement->execute($data)) {
            echo json_encode(["success" => "done"]);
        } else {
            echo json_encode(["success" => "failed"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
}






// header("Access-Control--Allow-Origin:*");
// header("Access-Control--Allow-Headers:*");
// header("Access-Control--Allow-Methods:*");

// $connect = new PDO ("mysql:host=127.0.0.1, dbname=login" "root", "password")

// if (&method === "POST") {
//     $form_data = json_decode(file_get_contents('php://input'));

//         $data = array(
//             ":email" => $form_data->email,
//             ":password" => $form_data->password
//         );
//         $query = " INSERT INTO registration (email, password) VALUES (:email,:password) ";

//         $statement = $connect->prepare($query);
//         $statement->execute($data);

//         echo json_decode (["sucess" => "done"]);

        

// }


















// Set CORS headers to allow requests from different origins
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: *");

// try {
//     // Database connection
//     $connect = new PDO("mysql:host=127.0.0.1;dbname=login", "root", "password");
//     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Check if the request method is POST
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         // Get JSON input data
//         $form_data = json_decode(file_get_contents('php://input'));

//         // Prepare data for the query
//         $data = array(
//             ":email" => $form_data->email,
//             ":password" => $form_data->password
//         );

//         // SQL query to insert data into the database
//         $query = "INSERT INTO registration (email, password) VALUES (:email, :password)";
//         $statement = $connect->prepare($query);
        
//         // Execute the query
//         if ($statement->execute($data)) {
//             echo json_encode(["success" => "done"]);
//         } else {
//             echo json_encode(["success" => "failed"]);
//         }
//     }
// } catch (PDOException $e) {
//     echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
// }


?>