<?php
    include 'example_persons.php';

    function getPartsFromFullname($str) {

            $key = ['surname', 'name', 'patronomyc'];
            
            $new_array = explode(' ', $str);
            $result = array_combine($key, $new_array);
        
        return $result;
        
    }

    function getFullnameFromParts($surname, $name, $patronomyc) {
        $result = $surname . ' ' . $name . ' ' . $patronomyc;
        return $result;
    }

    function getShortName($str) {
            $array = getPartsFromFullname($str);
            $temp_surname = mb_substr($array['surname'], 0, 1);
            $result = $array['name'] . ' ' . $temp_surname . '.';
            return $result;
     }

    $array = getPartsFromFullname($example_persons_array[2]['fullname']);
    print_r(getShortName($example_persons_array[2]['fullname']));
    
?>
