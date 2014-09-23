<?php
include __DIR__ . '/../../vendor/autoload.php';

$faker = Faker\Factory::create();

const NUMBER_OF_USERS = 25;

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

// books
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552149518', 'title' => 'Da Vinci Code,The', 'author' => 'Brown, Dan,'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747532743', 'title' => 'Harry Potter and the Philosopher\'s Stone', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747538486', 'title' => 'Harry Potter and the Chamber of Secrets', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552150736', 'title' => 'Angels and Demons', 'author' => 'Brown, Dan'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747551003', 'title' => 'Harry Potter and the Order of the Phoenix', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747581086', 'title' => 'Harry Potter and the Half-blood Prince', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747591054', 'title' => 'Harry Potter and the Deathly Hallows', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747546290', 'title' => 'Harry Potter and the Prisoner of Azkaban', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781904233657', 'title' => 'Twilight', 'author' => 'Meyer, Stephenie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747550990', 'title' => 'Harry Potter and the Goblet of Fire', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552151764', 'title' => 'Deception Point', 'author' => 'Brown, Dan'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781904233886', 'title' => 'New Moon', 'author' => 'Meyer, Stephenie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780330457729', 'title' => '"Lovely Bones,The"', 'author' => 'Sebold, Alice'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552151696', 'title' => 'Digital Fortress', 'author' => 'Brown, Dan'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099450252', 'title' => '"Curious Incident of the Dog in the Night-time,The"', 'author' => 'Haddon, Mark'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781904233916', 'title' => 'Eclipse', 'author' => 'Meyer, Stephenie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781847245458', 'title' => '"Girl with the Dragon Tattoo,The:Millennium Trilogy"', 'author' => 'Larsson, Stieg'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747566533', 'title' => '"Kite Runner,The"', 'author' => 'Hosseini, Khaled'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099464464', 'title' => '"Time Traveler\'s Wife,The"', 'author' => 'Niffenegger, Audrey'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141017891', 'title' => '"World According to Clarkson,The"', 'author' => 'Clarkson, Jeremy'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099429791', 'title' => 'Atonement', 'author' => 'McEwan, Ian'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780593054277', 'title' => '"Lost Symbol,The"', 'author' => 'Brown, Dan'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552997041', 'title' => '"Short History of Nearly Everything,A"', 'author' => 'Bryson, Bill'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781905654284', 'title' => 'Breaking Dawn', 'author' => 'Meyer, Stephenie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747546245', 'title' => 'Harry Potter and the Goblet of Fire', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747591061', 'title' => 'Harry Potter and the Deathly Hallows', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781849163422', 'title' => '"Girl Who Played With Fire,The:Millennium Trilogy"', 'author' => 'Larsson, Stieg'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780752837505', 'title' => '"Child Called It,A"', 'author' => 'Pelzer, Dave'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780349116754', 'title' => '"No.1 Ladies\' Detective Agency"', 'author' => 'McCall Smith, Alexander'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718147655', 'title' => 'You are What You Eat:The Plan That Will Change Your Life', 'author' => 'McKeith, Gillian'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780006512134', 'title' => 'Man and Boy', 'author' => 'Parsons, Tony'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099387916', 'title' => 'Birdsong', 'author' => 'Faulks, Sebastian'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780752877327', 'title' => 'Labyrinth', 'author' => 'Mosse, Kate'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780755309511', 'title' => '"Island,The"', 'author' => 'Hislop, Victoria'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781841953922', 'title' => 'Life of Pi', 'author' => 'Martel, Yann'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780091889487', 'title' => '"Dr. Atkin\' New Diet Revolution', 'author' => 'Atkins, Robert C.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747599876', 'title' => '"Tales of Beedle the Bard,The"', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780749397548', 'title' => 'Captain Corelli\'s Mandolin', 'author' => 'De Bernieres, Louis'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780563384304', 'title' => 'Delia\'s How to Cook:(Bk.1)', 'author' => 'Smith, Delia'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780330507417', 'title' => '"Gruffalo,The"', 'author' => 'Donaldson, Julia'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781861976123', 'title' => '"Eats, Shoots and Leaves:The Zero Tolerance Approach to Punctuation"', 'author' => 'Truss, Lynne'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780590660549', 'title' => 'Northern Lights:His Dark Materials S.', 'author' => 'Pullman, Philip'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780755331420', 'title' => '"Interpretation of Murder,The"', 'author' => 'Rubenfeld, Jed'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781849162746', 'title' => '"Girl Who Kicked the Hornets\' Nest,The:Millennium Trilogy"', 'author' => 'Larsson, Stieg'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780330367356', 'title' => 'Bridget Jones: The Edge of Reason', 'author' => 'Fielding, Helen'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141020525', 'title' => '"Short History of Tractors in Ukrainian,A"', 'author' => 'Lewycka, Marina'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780722532935', 'title' => '"Alchemist,The:A Fable About Following Your Dream"', 'author' => 'Coelho, Paulo'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552996006', 'title' => 'Notes from a Small Island', 'author' => 'Bryson, Bill'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099487821', 'title' => '"Boy in the Striped Pyjamas,The"', 'author' => 'Boyne, John'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141011905', 'title' => 'Stupid White Men:...and Other Sorry Excuses for the State of the Natio', 'author' => 'Moore, Michael'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718154776', 'title' => 'Jamie\'s 30-minute Meals', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099457169', 'title' => '"Broker,The"', 'author' => 'Grisham, John'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780330332774', 'title' => 'Bridget Jones\'s Diary:A Novel', 'author' => 'Fielding, Helen'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780241003008', 'title' => '"Very Hungry Caterpillar,The:The Very Hungry Caterpillar"', 'author' => 'Carle, Eric'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747582977', 'title' => '"Thousand Splendid Suns,A"', 'author' => 'Hosseini, Khaled'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781846051616', 'title' => '"Sound of Laughter,The"', 'author' => 'Kay, Peter'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718147709', 'title' => 'Jamie\'s Italy', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780755307500', 'title' => 'Small Island', 'author' => 'Levy, Andrea'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141030142', 'title' => '"Memory Keeper\'s Daughter,The"', 'author' => 'Edwards, Kim'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780007110926', 'title' => 'Billy Connolly', 'author' => 'Stephenson, Pamela'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780330448444', 'title' => '"House at Riverton,The"', 'author' => 'Morton, Kate'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747561071', 'title' => 'Harry Potter and the Order of the Phoenix', 'author' => 'Rowling, J. K.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780701181840', 'title' => 'Nigella Express', 'author' => 'Lawson, Nigella'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099771517', 'title' => 'Memoirs of a Geisha', 'author' => 'Golden, Arthur'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780563384311', 'title' => 'Delia\'s How to Cook:(Bk.2)', 'author' => 'Smith, Delia'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780590112895', 'title' => '"Subtle Knife,The:His Dark Materials S."', 'author' => 'Pullman, Philip'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718148621', 'title' => 'Jamie\'s Ministry of Food:Anyone Can Learn to Cook in 24 Hours', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781904994367', 'title' => 'Guinness World Records 2009:2009', 'author' => 'Various'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781861978769', 'title' => 'Why Don\'t Penguins\' Feet Freeze?:And 114 Other Questions', 'author' => 'Various'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718152437', 'title' => 'Jamie at Home:Cook Your Way to the Good Life', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780140276336', 'title' => 'White Teeth', 'author' => 'Smith, Zadie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780007156108', 'title' => '"Devil Wears Prada,The"', 'author' => 'Weisberger, Lauren'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780593059258', 'title' => 'At My Mother\'s Knee ...:and Other Low Joints', 'author' => 'O\'Grady, Paul'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780752893686', 'title' => 'No Time for Goodbye', 'author' => 'Barclay, Linwood'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780007207329', 'title' => '"""Times"" Su Doku,The:The Utterly Addictive Number-placing Puzzle:(Bk. 1"', 'author' => 'Various'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552998482', 'title' => 'Chocolat', 'author' => 'Harris, Joanne'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718144395', 'title' => '"Return of the Naked Chef,The"', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780006498407', 'title' => 'Angela\'s Ashes:A Memoir of a Childhood', 'author' => 'McCourt, Frank'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780747563204', 'title' => 'Schott\'s Original Miscellany', 'author' => 'Schott, Ben'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781847670946', 'title' => 'Dreams from My Father:A Story of Race and Inheritance', 'author' => 'Obama, Barack'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780007232741', 'title' => '"Dangerous Book for Boys,The"', 'author' => 'Iggulden, Conn & Iggulden, Hal'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099419785', 'title' => 'To Kill a Mockingbird', 'author' => 'Lee, Harper'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099406136', 'title' => '"Summons,The"', 'author' => 'Grisham, John'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552149525', 'title' => '"Lost Symbol,The"', 'author' => 'Brown, Dan'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780140237504', 'title' => '"Catcher in the Rye,The"', 'author' => 'Salinger, J.D.'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780593050545', 'title' => 'I Can Make You Thin', 'author' => 'McKenna, Paul'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780718144845', 'title' => 'Happy Days with the Naked Chef', 'author' => 'Oliver, Jamie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552771153', 'title' => 'Brick Lane', 'author' => 'Ali, Monica'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141019376', 'title' => 'Anybody Out There?', 'author' => 'Keyes, Marian'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552772747', 'title' => '"Undomestic Goddess,The"', 'author' => 'Kinsella, Sophie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552773898', 'title' => '"Book Thief,The"', 'author' => 'Zusak, Markus'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780141022925', 'title' => 'I Know You Got Soul', 'author' => 'Clarkson, Jeremy'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780316731317', 'title' => 'Sharon Osbourne Extreme:My Autobiography', 'author' => 'Osbourne, Sharon'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781904994497', 'title' => 'Guinness World Records 2010', 'author' => 'Various'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780439993586', 'title' => '"Amber Spyglass,The:His Dark Materials S."', 'author' => 'Pullman, Philip'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552771108', 'title' => 'Can You Keep a Secret?', 'author' => 'Kinsella, Sophie'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780552997034', 'title' => 'Down Under', 'author' => 'Bryson, Bill'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9780099506928', 'title' => '"Spot of Bother,A"', 'author' => 'Haddon, Mark'];
$books[] = ['book_id' => $faker->uuid, 'isbn'=>'9781846053443', 'title' => 'Dear Fatty', 'author' => 'French, Dawn'];

// borrowers
$borrowers = [];

foreach ($books as $book)
{
    if (mt_rand(0,1)) {
        $user = $users[mt_rand(0, NUMBER_OF_USERS-1)];

        $offset = mt_rand(1, 30);
        $period = mt_rand(0, 1) ? 'weeks' : 'days';
        $borrowedOn = date('Y-m-d', strtotime("-$offset $period"));


        $borrowers[] = [
            'book_id'     => $book['book_id'],
            'user_id'     => $user['user_id'],
            'borrowed_on' => $borrowedOn,
        ];
    }
}


// generate SQL
$sql = "DELETE FROM user;\n\n";
foreach ($users as $user) {
    $sql .= "INSERT INTO user ('user_id', 'username', 'password', 'name') VALUES\n";
    $sql .= "    ('{$user['user_id']}', '{$user['username']}', '{$user['password']}', '{$user['name']}');\n";
}
$sql .= "\n\n";

$sql .= "DELETE FROM book;\n\n";
foreach ($books as $book) {
    
    $title = str_replace("'", "''", $book['title']);
    $author = str_replace("'", "''", $book['author']);
    $sql .= "INSERT INTO book ('book_id', 'title', 'author', 'isbn') VALUES\n";
    $sql .= "    ('{$book['book_id']}', '$title', '$author', '{$book['isbn']}');\n";
}

$sql .= "\n\n";


$sql .= "DELETE FROM user_book;\n\n";
foreach ($borrowers as $borrower) {
    $sql .= "INSERT INTO user_book ('user_id', 'book_id', 'borrowed_on') VALUES\n";
    $sql .= "    ('{$borrower['user_id']}', '{$borrower['book_id']}', '{$borrower['borrowed_on']}');\n";
}
$sql .= "\n\n";


echo $sql;
