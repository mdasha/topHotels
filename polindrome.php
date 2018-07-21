<?php
/**
 * Created by PhpStorm.
 * User: Dasha
 * Date: 30.06.2018
 * Time: 21:45
 * @param $string
 * @param $start
 * @param $end
 * @param $i_start
 * @param $i_end
 * @return string
 */

header('Content-Type: text/html; charset=windows-1251');
echo '<!Doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
';

//Функция ищет палиндром при заданных параметрах
function pol($string, $start, $end, $i_start, $i_end)
{
    if ($start === $end) {
        if ($i_start < $i_end - 1) {
            $start = substr($string, $i_start + 1, 1);
            $end = substr($string, $i_end - 1, 1);
            return pol($string, $start, $end, $i_start + 1, $i_end - 1);
        } else {
            return true;
        }
    } else {
        return false;
    }
};

// Функция перебирает все возможные варианты палиндромов в строке и выводит результат
function polyndrome($string)
{
    $k = 0;
    echo '<h2>Дано:</h2> <b>Исходная строка: </b>'.$string;
    // Убираем пробелы из строки
    $string = str_replace(' ', '', $string);
    // Заменяем все буквы на строчные
    $string = mb_strtolower($string, 'windows-1251');
    // Определяем первую букву в строке
    $start = substr($string, 0, 1);
    // Определяем последнюю букву в строке
    $end = substr($string, -1, 1);
    //Определяем длину строки
    $length = strlen($string);

    echo '<br><b>Первая буква в строке:</b> '. $start;
    echo '<br><b>Последняя буква в строке:</b> '.$end.'<br>';

    for ($i = 0; $i <= $length - 1; $i++) {
        for ($j = $length - 1; $j >= 0; $j--) {
            if ($i === $j) {
                break;
            }
            $start = substr($string, $i, 1);
            $end = substr($string, $j, 1);
            $pol = pol($string, $start, $end, $i, $j);

            if ($pol) {
                // Вычисляем текущую длину палиндрома
                $pol_length[$i] = strlen(substr($string, $i, ($j - $i + 1)));
                // Вычисляем максимальную длину палиндрома и его ключ во внутреннем цикле - для каждого значения $i
                $max_length[$i] = max($pol_length);
                $max = array_keys($pol_length, max($pol_length))[0];
                // Заводим массив, чтобы определить максимум во внешнем цикле (если в строке более одного палиндрома)
                if ($pol_length [$i] === max($pol_length)) {
                    $k = $k + 1;
                    $start_max[$k] = $max;
                    $length_pol_max[$k] = $pol_length [$i];
                }
            }
        }
    };
    // Ищем максимальный палиндром и выводим результат работы программы
    if (isset($length_pol_max) and isset($pol_length) and isset($start_max)) {
        // Выбираем максимальный из нескольких найденных палиндромов и выводим результат на экран
        $max = array_keys($length_pol_max, max($length_pol_max))[0];
        echo '<h2>Результат:</h2>Это палиндром или подпалиндром<br>';
        echo '<b>Длина максимального палиндрома:</b> ' . max($pol_length).'<br>';
        echo '<b>Полиндром или подпалиндром</b>: ' . substr($string, $start_max[$max], max($pol_length)) . '<br>';
    } else {
        echo '<h2>Результат:</h2> Это не палиндром. В него нет входящих палиндромов<br>';
        echo '<b>Первая буква исходной строки:</b> ' . substr($string, 0, 1);
    }
}

// Проверяем программу для нескольких заданных строк
echo '<h2>Проверка № 1</h2>';
echo 'Палиндром из примера<br>';
polyndrome('Sum summus mus');

echo '<br><br><h2>Проверка № 2</h2>';
echo 'Нет палиндрома<br>';
polyndrome('Полиндром');

echo '<br><br><h2>Проверка № 3</h2>';
echo 'Палиндром внутри строки<br>';
polyndrome('Полинмдроордммор');

echo '<br><br><h2>Проверка № 4</h2>';
echo 'Пример из задания<br>';
polyndrome('Аргентина манит негра');

echo '<br><br><h2>Проверка № 5</h2>';
echo 'Палиндром в начале строки<br>';
polyndrome('Ромморвооыдпыопдыофпд');

echo '<br><br><h2>Проверка № 6</h2>';
echo 'В строке два палиндрома - ищем максимальный<br>';
polyndrome('Ромморвооыдпыовыдраардыв');
