<?php
/* http://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
 * http://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal
 */
function checkNIFv2($nif) {
    $nif = preg_replace('/[\s\-]+/','',strtoupper($nif));
    if(preg_match('/^(\d|[XYZ])\d{7}[A-Z]$/',$nif)) {
        preg_match('/\d+/',$nif,$num);
        $num = $num[0];
        $num = ($nif[0]!='Z'? $nif[0]!='Y'? 0: 1: 2).$num;
        if($nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[$num%23]) {
            return preg_match('/^\d/',$nif)? 'DNI': 'NIE';
        }
    }
    else if(preg_match('/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$/',$nif)) {
        for($sum=0,$i=1;$i<8;++$i) {
            $num = $nif[$i]<<$i%2;
            $uni = $num%10;
            $sum += ($num-$uni)/10+$uni;
        }
        $c = (10-$sum%10)%10;
        if((preg_match('/KLMNPQRSW/',$nif) && $nif[8]=='JABCDEFGHI'[$c]) ||
          (!preg_match('/KLMNPQRSW/',$nif) && $nif[8]==$c)) {
            return preg_match('/^[KLM]/',$nif)? 'ESP': 'CIF';
        }
    }
    return false;
}
?>
