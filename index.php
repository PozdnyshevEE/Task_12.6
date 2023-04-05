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

    function getGenderFromName($str) {
        
        $array = getPartsFromFullname($str);
        $totalSexAttribute = 0;
        $patronomyc = $array['patronomyc'];
        $name = $array['name'];
        $surname = $array['surname'];

        if ((mb_substr($patronomyc, -3)) === 'вна') {
            $totalSexAttribute -= 1;
        }
        else if ((mb_substr($patronomyc, -2)) === 'ич') {
            $totalSexAttribute += 1;
        }
        if ((mb_substr($name, -1)) === 'а') {
            $totalSexAttribute -= 1;
        }
        else if (((mb_substr($name, -1)) === 'й') || ((mb_substr($name, -1)) === 'н')) {
            $totalSexAttribute += 1;
        }
        if ((mb_substr($surname, -2)) === 'ва') {
            $totalSexAttribute -= 1;
        }
        else if ((mb_substr($surname, -1)) === 'в') {
            $totalSexAttribute += 1;
        }

        $totalSexAttribute = ($totalSexAttribute <=> 0);

        return $totalSexAttribute;
    }

    function getGenderDescription($array) {

        $count = count($array);
        $men = 0;
        $women = 0;
        $indeterminateGender = 0;
        
        for($i = 0; $i < $count; $i++) {
            foreach ($array[$i] as $key => $value) {
                if($key === 'fullname') {
                    $temp = getGenderFromName($value);
                    if ($temp === 1) {
                        $men += 1;
                    }
                    else if ($temp === -1) {
                        $women += 1;
                    }
                    else if ($temp === 0) {
                        $indeterminateGender += 1;
                    }
                }
            }
            $men_percent = round((($men * 100) / $count), 2);
            $women_percent = round((($women * 100) / $count), 2);
            $indeterminateGender_percent = round((($indeterminateGender * 100) / $count), 2);
        }

        print_r("Гендерный состав аудитории :<br/>");
        print_r("---------------------------------------<br/>");
        print_r("Мужчины - $men_percent%<br/>");
        print_r("Женщины - $women_percent%<br/>");
        print_r("Не удалось определить - $indeterminateGender_percent%");
    }

    print_r(getGenderDescription($example_persons_array));
?>
