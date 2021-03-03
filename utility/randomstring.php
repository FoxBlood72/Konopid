<?php
    function generateRandomString($length = 10) {
        $characters = 'A1BCDE7FG2HI8JKL5MNO9PQ3RSTUVW6XY4Z';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>