<?php
include __DIR__ . '/../../vendor/autoload.php';

$faker = Faker\Factory::create();

const NUMBER_OF_USERS = 25;
const NUMBER_OF_LISTS = 55;
const NUMBER_OF_TASKS_PER_LIST = 15;

// users
$users = [];
for ($i = 0; $i < NUMBER_OF_USERS; $i++) {
    $name = $faker->firstName . ' ' . str_replace("'", '', $faker->lastName);
    $user['user_id'] = $faker->uuid;
    $user['username'] = strtolower(preg_replace('/ /', '.', $name)) . '@example.com';
    $user['password'] = password_hash('password', PASSWORD_BCRYPT);
    $user['name'] = $name;

    $users[] = $user;
}

// lists
$lists = [];
for ($i = 0; $i < NUMBER_OF_LISTS; $i++) {
    $name = $faker->firstName . ' ' . $faker->lastName;
    $list['list_id'] = $faker->uuid;
    $list['title'] = ucwords(implode(' ', $faker->words));

    $offset = mt_rand(1, 30);
    $period = mt_rand(0, 1) ? 'weeks' : 'days';
    $list['created'] = date('U', strtotime("-$offset $period"));

    $lists[] = $list;
}

// tasks
$tasks = [];
foreach ($lists as $list) {
    $numberOfTasks = mt_rand(5, NUMBER_OF_TASKS_PER_LIST);
    for ($i = 0; $i < $numberOfTasks; $i++) {
        $name = $faker->firstName . ' ' . $faker->lastName;
        $task['task_id'] = $faker->uuid;
        $task['list_id'] = $list['list_id'];
        $task['name'] = ucfirst(implode(' ', $faker->words(mt_rand(4, 8))));
        $task['completed'] = mt_rand(0, 1);

        $tasks[] = $task;
    }
}

// links
$links = [];

// first pass - each list gets an owner
foreach ($lists as $i => $list) {
    if ($i >= NUMBER_OF_USERS) {
        $i = mt_rand(0, NUMBER_OF_USERS-1);
    }

    $user = $users[$i];
    $link['user_id'] = $user['user_id'];
    $link['list_id'] = $list['list_id'];
    $link['is_owner'] = 1;
    $link['can_read'] = 1;
    $link['can_write'] = 1;

    $links[$user['user_id'].$list['list_id']] = $link;
}

// second pass - each list gets a reader who isn't an owner
foreach ($lists as $i => $list) {
    do {
        $index = mt_rand(0, NUMBER_OF_USERS-1) ;
    } while (isset($links[$users[$index]['user_id'].$list['list_id']]));

    $user = $users[$index];
    $link['user_id'] = $user['user_id'];
    $link['list_id'] = $list['list_id'];
    $link['is_owner'] = 0;
    $link['can_read'] = 1;
    $link['can_write'] = 0;

    $links[$user['user_id'].$list['list_id']] = $link;
}

// generate SQL
$sql = "DELETE FROM 'user';\n\n";
foreach ($users as $user) {
    $sql .= "INSERT INTO 'user' ('user_id', 'username', 'password', 'name') VALUES\n";
    $sql .= "    ('{$user['user_id']}', '{$user['username']}', '{$user['password']}', '{$user['name']}');\n";
}
$sql .= "\n\n";

$sql .= "DELETE FROM 'list';\n\n";
foreach ($lists as $list) {
    $sql .= "INSERT INTO 'list' ('list_id', 'title', 'created') VALUES\n";
    $sql .= "    ('{$list['list_id']}', '{$list['title']}', '{$list['created']}');\n";
}
$sql .= "\n\n";

$sql .= "DELETE FROM 'task';\n\n";
foreach ($tasks as $task) {
    $sql .= "INSERT INTO 'task' ('task_id', 'list_id', 'name', 'completed') VALUES\n";
    $sql .= "    ('{$task['task_id']}', '{$task['list_id']}', '{$task['name']}', '{$task['completed']}');\n";
}
$sql .= "\n\n";


$sql .= "DELETE FROM 'user_list';\n\n";
foreach ($links as $link) {
    $sql .= "INSERT INTO 'user_list' ('user_id', 'list_id', 'is_owner', 'can_read', 'can_write') VALUES\n";
    $sql .= "    ('{$link['user_id']}', '{$link['list_id']}', '{$link['is_owner']}', '{$link['can_read']}', '{$link['can_write']}');\n";
}
$sql .= "\n\n";


echo $sql;
