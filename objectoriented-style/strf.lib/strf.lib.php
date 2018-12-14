<?php

class Strf
{
    public static function StartsWith($haystack, $needle)
    {
        return (substr($haystack, 0, strlen($needle)) === $needle);
    }

    public static function EndsWith($haystack, $needle)
    {
        return strlen($needle) === 0 || (substr($haystack, -strlen($needle)) === $needle);
    }

    public static function SReplace($subject, $specialCharacters = "")
    {
        $subject = str_replace(' ','-',$subject);
        $subject = str_replace('&Auml;','AE',$subject);
        $subject = str_replace('&auml;','ae',$subject);
        $subject = str_replace('&Ouml;','OE',$subject);
        $subject = str_replace('&ouml;','oe',$subject);
        $subject = str_replace('&Uuml;','UE',$subject);
        $subject = str_replace('&uuml;','ue',$subject);
        $subject = str_replace('&szlig;','ss',$subject);

        $subject = str_replace('Ä','AE',$subject);
        $subject = str_replace('ä','ae',$subject);
        $subject = str_replace('Ö','OE',$subject);
        $subject = str_replace('ö','oe',$subject);
        $subject = str_replace('Ü','UE',$subject);
        $subject = str_replace('ü','ue',$subject);
        $subject = str_replace('ß','ss',$subject);

        $subject = preg_replace('/[^0-9A-Za-z-()=+-*~_'.$specialCharacters.'\|]/', '', $subject);

        return $subject;
    }

    public static function Contains()
    {
        $amt = func_num_args();
        $search = func_get_args();

        $subject = strtolower($search[0]);
        $retval=false;

        for($i=1;$i<$amt;$i++) if(str_replace(strtolower($search[$i]),'',$subject)!=$subject) $retval = true;
        return $sretval;
    }
}

?>