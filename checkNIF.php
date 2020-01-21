<?php
function checkNIF($nif) {
    $nif = preg_replace('/[_\W\s]+/','',strtoupper($nif));
    if(preg_match('/^(\d|[XYZ])\d{7}[A-Z]$/',$nif)) {
        preg_match('/\d+/',$nif,$num);
        $num = ($nif[0]!='Z'? $nif[0]!='Y'? 0: 1: 2).$num[0];
        if($nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[$num%23]) {
            return preg_match('/^\d/',$nif)? 'DNI': 'NIE';
        }
    }
    else if(preg_match('/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$/',$nif)) {
        for($sum=0,$i=1;$i<8;++$i) {
            $num = $nif[$i]<<$i%2;
            $sum += int($num/10)+$num%10;
        }
        $c = (10-$sum)%10;
        if(((preg_match('/KLMNPQRSW/',$nif) || ($nif[1].$nif[2])=='00') && $nif[8]=='JABCDEFGHI'[$c]) ||
            (preg_match('/ABEH/',$nif) && $nif[8]==$c) ||
            (preg_match('/CDFGJUV/',$nif) && ($nif[8]=='JABCDEFGHI'[$c] || $nif[8]==$c)) ) {
            return preg_match('/^[KLM]/',$nif)? 'ESP': 'CIF';
        }
    }
    return false;
}
?>