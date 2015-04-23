<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

	$lang = "en";
	$root = "en_EN";
	
if($_GET["lang"]) {
	$lang = $_GET["lang"];
	if($lang == ("en") OR ("english") OR ("us")) {
		$root = "en_EN";
	}
	if($lang == ("fr") OR ("france") OR ("fra")) {
		$root = "fr_FR";
	}
}
$gender = array("male", "female");
$gender1 = $gender[rand(0, 1)];
$firstname = file("{$root}/firstname_{$gender1}.txt");
$firstname1 = $firstname[round(rand(0, count($firstname) - 1))];
$middlename = $firstname[round(rand(0, count($firstname) - 1))];
$lastname = file("{$root}/lastname.txt");
$lastname1 = $lastname[round(rand(0, count($lastname) - 1))];
$job = file("{$root}/jobs.txt");
$job1 = $job[round(rand(0, count($job) - 1))];
$email = file("{$root}/email.txt");
$email1 = $email[round(rand(1, count($email) - 1))];
$email1 = strtolower($lastname1.$firstname1.$email1);
$age = rand(18, 99);
if($age >= 65) {
	switch ($lang) {
		case "fr"; case "fra"; case "france": $job1 = "Retraité"; break;
		case "en"; case "us"; case "english": $job1 = "Retired"; break;
	}
}
switch ($gender1) {
	case "male": $gender = "Mr"; break;
	case "female": $gender = "Mrs"; break;
}
echo "<pre>";
$data = array(
		"message" => array(
		"fr" => "L'API est toujours pas fini, il y aura des erreurs...",
		"en" => "The API is still not finished, there will be a few errors..."
		),
		"title" => $gender,
		"firstname" => $firstname1,
		"middlename" => $middlename,
		"lastname" => $lastname1,
		"initials" => strtolower($firstname1[0].$middlename[0].$lastname1[0]),
		"age" => $age,
		"job" => $job1,
		"email" => $email1,
		"phone" => 
		array("us" => "+1-".rand(100, 999)."-".rand(111, 999)."-".rand(1111, 9999)."",
		"fr" => "+33-0".rand(4, 6)."-".rand(11, 99)."-".rand(11, 99)."-".rand(11, 99)));
$json0 = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$json1 = str_ireplace("\\n", "", $json0);

print_r($json1);
echo "</pre>";	

$out = json_decode($json1);
