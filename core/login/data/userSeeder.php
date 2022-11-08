<?php


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once "{$base_dir}Login.php";

$seeder = null;
$login = new Login();

$users[] = array();

$users[0]['login'] = "Artem";
$users[0]['password'] = "123123123";
$users[0]['role_id'] = 1;
$users[0]['first_name'] = "Artem";
$users[0]['last_name'] = "Tjumen";
$users[0]['email'] = "artem@gmx.de";
$users[0]['mobile'] = "0176 12345678";
$users[0]['tel'] = "030 12345678";
$users[0]['address'] = "Muster Straße 123, 12345 Musterstadt";
$users[0]['info'] = "My test-user ...";

$users[1]['login'] = "Superadmin";
$users[1]['password'] = "123123123";
$users[1]['role_id'] = 2;
$users[1]['first_name'] = "Roman";
$users[1]['last_name'] = "Tjumen";
$users[1]['email'] = "ivan@gmx.de";
$users[1]['mobile'] = "0176 12345678";
$users[1]['tel'] = "030 12345678";
$users[1]['address'] = "Muster Straße 123, 12345 Musterstadt";
$users[1]['info'] = "My test-user ...";

$users[2]['login'] = "Admin";
$users[2]['password'] = "123123123";
$users[2]['role_id'] = 3;
$users[2]['first_name'] = "Ivan";
$users[2]['last_name'] = "Berlin";
$users[2]['email'] = "ivan@gmx.de";
$users[2]['mobile'] = "0176 12345678";
$users[2]['tel'] = "030 12345678";
$users[2]['address'] = "Muster Straße 123, 12345 Musterstadt";
$users[2]['info'] = "My test-user ...";

$users[3]['login'] = "Moderator";
$users[3]['password'] = "123123123";
$users[3]['role_id'] = 4;
$users[3]['first_name'] = "Wladimir";
$users[3]['last_name'] = "Guckengeimer";
$users[3]['email'] = "wladimir@gmx.de";
$users[3]['mobile'] = "0176 12345678";
$users[3]['tel'] = "030 12345678";
$users[3]['address'] = "Muster Straße 123, 12345 Musterstadt";
$users[3]['info'] = "My test-user ...";

$users[4]['login'] = "User";
$users[4]['password'] = "123123123";
$users[4]['role_id'] = 5;
$users[4]['first_name'] = "User1";
$users[4]['last_name'] = "Guckengeimer";
$users[4]['email'] = "wladimir@gmx.de";
$users[4]['mobile'] = "0176 12345678";
$users[4]['tel'] = "030 12345678";
$users[4]['address'] = "Muster Straße 123, 12345 Musterstadt";
$users[4]['info'] = "My test-user ...";

foreach ($users as $data) {
    $seed = $login->seeder($data);
}

echo json_encode($seed);

