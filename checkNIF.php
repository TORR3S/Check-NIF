<?php
function checkNIF($nif) {
    $nif = preg_replace('/[_\W\s]+/','',strtoupper($nif));
    if(preg_match('/^(\d|[XYZ])\d{7}[A-Z]$/',$nif)) {
        preg_match('/\d+/',$nif,$nu);
        $nu = $nu[0];
        $nu = ($nif[0]!='Z'? $nif[0]!='Y'? 0: 1: 2).$nu;
        if($nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[$nu%23]) {
            return preg_match('/^\d/',$nif)? 'DNI': 'NIE';
        }
    }
    else if(preg_match('/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$/',$nif)) {
        for($su=0,$i=1;$i<8;++$i) {
            $nu = $nif[$i]<<$i%2;
            $un = $nu%10;
            $su += ($nu-$un)/10+$un;
        }
        $c = (10-$su)%10;
        if((preg_match('/KLMNPQRSW/',$nif) && $nif[8]=='JABCDEFGHI'[$c]) ||
          (!preg_match('/KLMNPQRSW/',$nif) && $nif[8]==$c)) {
            return preg_match('/^[KLM]/',$nif)? 'ESP': 'CIF';
        }
    }
    return false;
}
?>