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

//������� ���� ��������� ��� �������� ����������
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

// ������� ���������� ��� ��������� �������� ����������� � ������ � ������� ���������
function polyndrome($string)
{
    $k = 0;
    echo '<h2>����:</h2> <b>�������� ������: </b>'.$string;
    // ������� ������� �� ������
    $string = str_replace(' ', '', $string);
    // �������� ��� ����� �� ��������
    $string = mb_strtolower($string, 'windows-1251');
    // ���������� ������ ����� � ������
    $start = substr($string, 0, 1);
    // ���������� ��������� ����� � ������
    $end = substr($string, -1, 1);
    //���������� ����� ������
    $length = strlen($string);

    echo '<br><b>������ ����� � ������:</b> '. $start;
    echo '<br><b>��������� ����� � ������:</b> '.$end.'<br>';

    for ($i = 0; $i <= $length - 1; $i++) {
        for ($j = $length - 1; $j >= 0; $j--) {
            if ($i === $j) {
                break;
            }
            $start = substr($string, $i, 1);
            $end = substr($string, $j, 1);
            $pol = pol($string, $start, $end, $i, $j);

            if ($pol) {
                // ��������� ������� ����� ����������
                $pol_length[$i] = strlen(substr($string, $i, ($j - $i + 1)));
                // ��������� ������������ ����� ���������� � ��� ���� �� ���������� ����� - ��� ������� �������� $i
                $max_length[$i] = max($pol_length);
                $max = array_keys($pol_length, max($pol_length))[0];
                // ������� ������, ����� ���������� �������� �� ������� ����� (���� � ������ ����� ������ ����������)
                if ($pol_length [$i] === max($pol_length)) {
                    $k = $k + 1;
                    $start_max[$k] = $max;
                    $length_pol_max[$k] = $pol_length [$i];
                }
            }
        }
    };
    // ���� ������������ ��������� � ������� ��������� ������ ���������
    if (isset($length_pol_max) and isset($pol_length) and isset($start_max)) {
        // �������� ������������ �� ���������� ��������� ����������� � ������� ��������� �� �����
        $max = array_keys($length_pol_max, max($length_pol_max))[0];
        echo '<h2>���������:</h2>��� ��������� ��� ������������<br>';
        echo '<b>����� ������������� ����������:</b> ' . max($pol_length).'<br>';
        echo '<b>��������� ��� ������������</b>: ' . substr($string, $start_max[$max], max($pol_length)) . '<br>';
    } else {
        echo '<h2>���������:</h2> ��� �� ���������. � ���� ��� �������� �����������<br>';
        echo '<b>������ ����� �������� ������:</b> ' . substr($string, 0, 1);
    }
}

// ��������� ��������� ��� ���������� �������� �����
echo '<h2>�������� � 1</h2>';
echo '��������� �� �������<br>';
polyndrome('Sum summus mus');

echo '<br><br><h2>�������� � 2</h2>';
echo '��� ����������<br>';
polyndrome('���������');

echo '<br><br><h2>�������� � 3</h2>';
echo '��������� ������ ������<br>';
polyndrome('����������������');

echo '<br><br><h2>�������� � 4</h2>';
echo '������ �� �������<br>';
polyndrome('��������� ����� �����');

echo '<br><br><h2>�������� � 5</h2>';
echo '��������� � ������ ������<br>';
polyndrome('���������������������');

echo '<br><br><h2>�������� � 6</h2>';
echo '� ������ ��� ���������� - ���� ������������<br>';
polyndrome('������������������������');
