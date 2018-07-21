<?php
/**
 * Created by PhpStorm.
 * User: Dasha
 * Date: 01.07.2018
 * Time: 21:10
 */


$host = "localhost";
$user = "root";
$password = "";
$database = "tophotels";


$db = mysqli_connect($host, $user, $password, $database) or die("Ошибка ".  mysqli_error($db));

//$query ="CREATE Table category
//(
//    id INT NOT NULL PRIMARY KEY,
//    parent_category_id INT REFERENCES category(id),
//    name VARCHAR(100) NOT NULL
//)";

//$result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
//
//if($result)
//{
//    echo "Создание таблицы прошло успешно";
//}

$group_add_result =  $db -> query("SELECT * from `category` where name LIKE 'авто%' and parent_category_id = '0'");
$j1=0;
$j=0;
while ($tablerows123 = $group_add_result->fetch_array(MYSQLI_NUM)) {
    for ($i=0; $i<=2; $i++) {
        $aaa[$j]=$tablerows123[$i];
        $group_add_array[$j1][$i]=$aaa[$j];
        $j++;
    }
    $j1++;
}
$count_adds = $j1;

echo 'Количество категорий верхнего уровня, у которых имя начинается на авто: '.$count_adds.'<br>';
if (isset($group_add_array)) {
    for ($i = 0; $i < $count_adds; $i++) {
        echo "Название категории: " . $group_add_array[$i][2].'<br>';
    }
}

mysqli_close($db);
