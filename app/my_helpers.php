<?php
// date time helpers
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Arr;

if (!function_exists('get_date_time')) {
    function get_date_time()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }
}
// date helper
if (!function_exists('get_date')) {
    function get_date()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d');
    }
}
if (!function_exists('get_month')) {
    function get_month()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y');
    }
}
if (!function_exists('get_year')) {
    function get_year()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('m');
    }
}
// show time like this ( 02:34:PM )
if (!function_exists('show_AM_PM_time')) {
    function show_AM_PM_time($time)
    {
        return date("g:i A", strtotime($time));
    }
}
// show time like this ( 02:34 )
if (!function_exists('show_only_HHMM')) {
    function show_only_HHMM($seconds)
    {
        $hrs = $seconds / 60;
        $mins = $hrs % 60;
        $hrs = $hrs / 60;
        $result = (int)$hrs . " hrs  " . (int)$mins . " mints";
        return $result;
    }
}
// show date like this ( 16/07/2022 )
if (!function_exists('date_with_slash')) {
    function date_with_slash($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}
// show date like this ( 16 sep 2022 )
if (!function_exists('date_with_month_name')) {
    function date_with_month_name($date)
    {
        return date('d M Y', strtotime($date));
    }
}
// convert seconds to  Hours , Minutes, Seconds
if (!function_exists('seconds_to_hours_mints_secs')) {
    function seconds_to_hours_mints_secs($seconds)
    {
        $secs = $seconds % 60;
        $hrs = $seconds / 60;
        $mins = $hrs % 60;
        $hrs = $hrs / 60;
        $result = (int)$hrs . ":" . (int)$mins . ":" . (int)$secs;
        return $result;
    }
}
// convert seconds to  Hours , Minutes, Seconds
if (!function_exists('seconds_to_hours_minutes')) {
    function seconds_to_hours_minutes($seconds)
    {
        $hrs = $seconds / 60;
        $mins = $hrs % 60;
        $hrs = $hrs / 60;
        $result = (int)$hrs . "." . (int)$mins;
        return $result;
    }
}
// convert seconds to only Hours
if (!function_exists('seconds_to_hours')) {
    function seconds_to_hours($seconds)
    {
        $hrs = $seconds / 60;
        $hrs = $hrs / 60;
        $result = (int)$hrs;

        return $result;
    }
}
// convert seconds to Day , Hours , Minutes, Seconds
if (!function_exists('seconds_to_M_D_H_M_S')) {
    function seconds_to_M_D_H_M_S($ss)
    {
        $s = $ss % 60;
        $m = floor(($ss % 3600) / 60);
        $h = floor(($ss % 86400) / 3600);
        $d = floor(($ss % 2592000) / 86400);
        $M = floor($ss / 2592000);
        $result = "$M:$d:$h:$m:$s";
        return $result;
    }
}
// convert Time to seconds and add total seconds and return it with total hours..... 
if (!function_exists('convert_time_seconds')) {
    function convert_time_seconds($time)
    {
        $tym = array_reverse(explode(':', $time));
        // $tym = array_reverse(explode(':', $time));
        // var_dump($tym);
        $hr = $tym[2] ?? 0;
        $min = $tym[1] ?? 0;
        return $hr * 60 * 60 + $min * 60 + $tym[0];
    }
}
// date time helpers
if (!function_exists('get_time')) {
    function get_time()
    {
        $tz_object = new DateTimeZone('Asia/Karachi');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('H:i:s');
    }
}
// date time helpers
if (!function_exists('parse_datetime_get_datepicker')) {
    function parse_datetime_get_datepicker($date)
    {
        return date('Y-m-d\TH:i', strtotime($date));
    }
}
// calculateTime two times helpers
if (!function_exists('calculateTime')) {
    function calculateTime($time1, $time2)
    {
        $secs = strtotime($time2) - strtotime("00:00:00");
        $result = date("H:i:s", strtotime($time1) + $secs);
        return $result;
    }
}
// get difference between two times helpers
if (!function_exists('difference_bwt_two_times')) {
    function difference_bwt_two_times($t1, $t2)
    {
        if (($t1 == '') || ($t2 == '')) {
            $date = new DateTime('00:00:00');
            $result = $date->format('H:i:s');
        } else {
            $time1 = new Carbon($t1);
            $time2 = new Carbon($t2);
            $diff = $time2->diff($time1);
            $hours = $diff->h;
            $mins = $diff->i;
            $sec = $diff->s;
            $hours = $hours + ($diff->days * 24);
            $my_date = new DateTime($hours . ":" . $mins . ":" . $sec);
            $result = $my_date->format('H:i:s');
        }
        return $result;
    }
}
if (!function_exists('parse_datetime_get')) {
    function parse_datetime_get($date)
    {
        $datetime = new DateTime($date);
        return $datetime->format('d/m/Y g:i A');
    }
}
// parse date to for db
if (!function_exists('parse_date_store')) {
    function parse_date_store($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}
// parse date to for db
if (!function_exists('parse_datetime_store')) {
    function parse_datetime_store($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
}
// parse date to for get
if (!function_exists('parse_date_get')) {
    function parse_date_get($date)
    {
        return date('d-m-Y', strtotime($date));
    }
}
// Get last name form full name
if (!function_exists('get_last_name')) {
    function get_last_name($name)
    {
        $last_name =  explode(' ', $name);
        $result = Arr::last($last_name);
        return $result;
    }
}
// Get first name form full name
if (!function_exists('get_first_name')) {
    function get_first_name($name)
    {
        $first_name =  explode(' ', $name);
        $result = $first_name[0];
        return $result;
    }
}
// encrypt password
if (!function_exists('encrypt_password')) {
    function encrypt_password($password)
    {
        return sha1(md5($password . 'Looper$alt'));
    }
}
// slugify
if (!function_exists('slugify')) {
    function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, $divider);
        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
// Generate random access token key
if (!function_exists('rand_str')) {
    function rand_str()
    {
        $characters = '0123456789-=+{}[]:;@#~.?/&gt;,&lt;|\!"£$%^&amp;*()abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomstr = '';
        for ($i = 0; $i < random_int(50, 100); $i++) {
            $randomstr .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomstr;
    }
}
//Calculate total working days of a  month
if (!function_exists('get_month_days')) {
    function get_month_days($m, $y)
    {
        $lastday = date("t", mktime(0, 0, 0, $m, 1, $y));
        $weekdays = 0;
        for ($d = 29; $d <= $lastday; $d++) {
            $wd = date("w", mktime(0, 0, 0, $m, $d, $y));
            if ($wd > 0 && $wd < 6) $weekdays++;
        }
        return $weekdays + 20;
    }
}


/* End of file custom_helpers.php */
/* Created by Abdullah Afridi full stack developer */ 
/* Location: ./application/helpers/custom_helpers.php */
