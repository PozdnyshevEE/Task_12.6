<?php
    include 'example_persons.php';

    function getPartsFromFullname($array) {

            $key = ['surname', 'name', 'patronomyc'];
            $str = $array['fullname'];
            
            $new_array = explode(' ', $str);
            $result = array_combine($key, $new_array);
        
        return $result;
        
    }

    function getFullnameFromParts($surname, $name, $patronomyc) {
        $result = $surname . ' ' . $name . ' ' . $patronomyc;
        return $result;
    }

    $array = getPartsFromFullname($example_persons_array[8]);
    print_r(getFullnameFromParts($array['surname'], $array['name'], $array['patronomyc']));
    
?>