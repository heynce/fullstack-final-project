<?php 
	include 'signup.php';
	include 'connection.php';
	include 'user-service.php';
	include 'login.php';

	$db = new Database();
	$userService = new User($db);

	$requestMethod = $_SERVER["REQUEST_METHOD"];
	if ($requestMethod === 'GET') {
		// perform read operations from User Class
		$results = $userService->read();
		if ($results->num_rows > 0) {
			http_response_code(200);
			echo json_encode($results->fetch_all(MYSQLI_ASSOC));
		} else {
			http_response_code(200);
			echo json_encode(array("message" => "No user data", "status" => 200));
		}

	} elseif ($requestMethod === 'POST') {
		// Create new user inside users table.
		$data = json_decode(file_get_contents("php://input"));
		$userService->username = $data->username;
		$userService->email = $data->email;

		if ($userService->create()) {
			http_response_code(201);
			echo json_encode(array("message" => "User created successfully", "status" => 201));
		} else {
			http_response_code(500);
			echo json_encode(array("message" => "Error while create new user", "status" => 500));
		}
	} elseif ($requestMethod === "PATCH" || $requestMethod === "PUT") {
		// for updating any user
	} elseif($requestMethod === "DELETE") {
		// for delete any user
	} else {
		http_response_code(405);
		echo json_encode(array("message" => "Request not allowed", "status" => 405));
	}
?>