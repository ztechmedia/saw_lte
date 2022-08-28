<?php

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    die();
    echo "</pre>";
}

function getPost()
{
    $ci = &get_instance();
    $posts = $ci->input->post();
    $form = [];
    foreach ($posts as $post => $value) {
        $form[$post] = $value;
    }
    return $form;
}

function checkGrade($value)
{
    if($value >= 0.1 && $value <= 0.25) {
        return "D";
    } else if($value >= 0.26 && $value <= 0.50) {
        return "C";
    } else if($value >= 0.51 && $value <= 0.75) {
        return "B";
    } else if($value >= 0.76 && $value <= 1) {
        return "A";
    }
}

function toDateTime($date)
{
    return date_format($date, "d/m/Y H:i:s");
}

function mToMonth($m)
{
    $m = intval($m);
    $month = [
        "1" => "Januari",
        "2" => "Februari",
        "3" => "Maret",
        "4" => "April",
        "5" => "Mei",
        "6" => "Juni",
        "7" => "Juli",
        "8" => "Agustus",
        "9" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember",
    ];

    return $month[$m];
}

function toIndoDate($date)
{
    $date = explode("-", $date);
    $month = mToMonth($date[1]);
    return $date[2] . " " . $month . " " . $date[0];
}

function toIndoDateDay($date)
{
    $dayName = dayname(date("D", strtotime($date)));
    $date = explode("-", $date);
    $month = mToMonth($date[1]);
    return $dayName . ", " . $date[2] . " " . $month . " " . $date[0];
}

function toIndoDateTime($date)
{
    $datetime = explode(" ", $date);
    $date = toIndoDateDay($datetime[0]);
    $time = $datetime[1];

    return $date." ".$time;
}

function dayName($number)
{
    $days = [
        "Mon" => "Senin",
        "Tue" => "Selasa",
        "Wed" => "Rabu",
        "Thu" => "Kamis",
        "Fri" => "Jumat",
        "Sat" => "Sabtu",
        "Sun" => "Minggu",
    ];
    return $days[$number];
}

function revDate($date)
{
    $date = explode("-", $date);
    return "$date[2]-$date[1]-$date[0]";
}

function cryptoRandSecure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) {
        return $min;
    }
    // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function genUnique($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[cryptoRandSecure(0, $max - 1)];
    }

    return $token;
}

function asset($url)
{
    return base_url("assets/$url");
}

function max_length($string, $max)
{
    $stringLength = strlen($string);
    $result = substr($string, 0, $max);
    if ($stringLength > $max) {
        return $result . "...";
    } else {
        return $string;
    }
}

function simple_crypt($string, $action = 'e')
{
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function isUnique($value, $params)
{
    $ci = &get_instance();
    $params = explode(".", $params);

    $table = $params[0];
    $field = $params[1];

    $ci->db->where($field, $value);

    if (count($params) === 3) {
        $id = $params[2];
        $ci->db->where_not_in('id', $id);
    }

    $data = $ci->db->limit(1)->get($table)->result();
    return $data ? false : true;
}
