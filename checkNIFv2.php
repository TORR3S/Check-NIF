<?php
/* https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
 * https://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal
 */
$NIF_Type = [
    'A'=>'Sociedad Anónima',
    'B'=>'Sociedad de Responsabilidad Limitada',
    'C'=>'Sociedad Colectiva',
    'D'=>'Sociedad Comanditaria',
    'E'=>'Comunidad de Bienes',
    'F'=>'Sociedad Cooperativa',
    'G'=>'Asociación o Fundación',
    'H'=>'Comunidad de Propietarios en Régimen de Propiedad Horizontal',
    'J'=>'Sociedad Civil, con o sin Personalidad Jurídica',
    'K'=>'Español menor de 14 años',
    'L'=>'Español residente en el extranjero sin DNI',
    'M'=>'NIF que otorga la Agencia Tributaria a extranjeros que no tienen NIE',
    'N'=>'Entidad Extranjera',
    'P'=>'Corporación Local',
    'Q'=>'Organismo Autónomo, Estatal o no, o Asimilado, o Congregación o Institución Religiosa',
    'R'=>'Congregación o Institución Religiosa (desde 2008, ORDEN EHA/451/2008)',
    'S'=>'Órgano de la Administración General del Estado o de las Comunidades Autónomas',
    'U'=>'Unión Temporal de Empresas',
    'V'=>'Sociedad Agraria de Transformación',
    'W'=>'Establecimiento permanente de Entidad no residente en España',
    'X'=>'Extranjero identificado por la Policía con un número de identidad de extranjero, NIE, asignado hasta el 15 de julio de 2008',
    'Y'=>'Extranjero identificado por la Policía con un NIE, asignado desde el 16 de julio de 2008 (Orden INT/2058/2008, BOE del 15 de julio)',
    'Z'=>'Letra reservada para cuando se agoten los "Y" para Extranjeros identificados por la Policía con un NIE'
];
$CIF_Prov = [
    '00'=>'No Residente',
    '01'=>'Álava',
    '02'=>'Albacete',
    '03'=>'Alicante',
    '53'=>'Alicante',
    '54'=>'Alicante',
    '04'=>'Almería',
    '05'=>'Ávila',
    '06'=>'Badajoz',
    '07'=>'Islas Baleares',
    '57'=>'Islas Baleares',
    '08'=>'Barcelona',
    '58'=>'Barcelona',
    '59'=>'Barcelona',
    '60'=>'Barcelona',
    '61'=>'Barcelona',
    '62'=>'Barcelona',
    '63'=>'Barcelona',
    '64'=>'Barcelona',
    '65'=>'Barcelona',
    '66'=>'Barcelona',
    '68'=>'Barcelona',
    '09'=>'Burgos',
    '10'=>'Cáceres',
    '11'=>'Cádiz',
    '72'=>'Cádiz',
    '12'=>'Castellón',
    '13'=>'Ciudad Real',
    '14'=>'Córdoba',
    '56'=>'Córdoba',
    '15'=>'La Coruña',
    '70'=>'La Coruña',
    '16'=>'Cuenca',
    '17'=>'Gerona',
    '55'=>'Gerona',
    '67'=>'Gerona',
    '18'=>'Granada',
    '19'=>'Guadalajara',
    '20'=>'Guipúzcoa',
    '71'=>'Guipúzcoa',
    '21'=>'Huelva',
    '22'=>'Huesca',
    '23'=>'Jaén',
    '24'=>'León',
    '25'=>'Lérida',
    '26'=>'La Rioja',
    '27'=>'Lugo',
    '28'=>'Madrid',
    '78'=>'Madrid',
    '79'=>'Madrid',
    '80'=>'Madrid',
    '81'=>'Madrid',
    '82'=>'Madrid',
    '83'=>'Madrid',
    '84'=>'Madrid',
    '85'=>'Madrid',
    '86'=>'Madrid',
    '87'=>'Madrid',
    '29'=>'Málaga',
    '92'=>'Málaga',
    '93'=>'Málaga',
    '30'=>'Murcia',
    '73'=>'Murcia',
    '31'=>'Navarra',
    '71'=>'Navarra',
    '32'=>'Orense',
    '33'=>'Asturias',
    '74'=>'Asturias',
    '34'=>'Palencia',
    '35'=>'Las Palmas',
    '76'=>'Las Palmas',
    '36'=>'Pontevedra',
    '27'=>'Pontevedra',
    '94'=>'Pontevedra',
    '37'=>'Salamanca',
    '38'=>'Santa Cruz de Tenerife',
    '75'=>'Santa Cruz de Tenerife',
    '39'=>'Cantabria',
    '40'=>'Segovia',
    '41'=>'Sevilla',
    '90'=>'Sevilla',
    '91'=>'Sevilla',
    '42'=>'Soria',
    '43'=>'Tarragona',
    '77'=>'Tarragona',
    '44'=>'Teruel',
    '45'=>'Toledo',
    '46'=>'Valencia',
    '96'=>'Valencia',
    '97'=>'Valencia',
    '98'=>'Valencia',
    '47'=>'Valladolid',
    '48'=>'Vizcaya',
    '95'=>'Vizcaya',
    '49'=>'Zamora',
    '50'=>'Zaragoza',
    '99'=>'Zaragoza',
    '51'=>'Ceuta',
    '52'=>'Melilla'
];
function checkNIFv2($nif) {
    global $NIF_Type;
    global $CIF_Prov;
    $nif = preg_replace('/[\s\-]+/','',strtoupper($nif));
    if(preg_match('/^(\d|[XYZ])\d{7}[A-Z]$/',$nif)) {
        preg_match('/\d+/',$nif,$num);
        $num = $num[0];
        $num = ($nif[0]!='Z'? $nif[0]!='Y'? 0: 1: 2).$num;
        if($nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[$num%23]) {
            return preg_match('/^\d/',$nif)? 'DNI': 'NIE: '.$NIF_Type[$nif[0]];
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
            return (preg_match('/^[KLM]/',$nif)? 'ESP:':
             'CIF: ('.$CIF_Prov[substr($nif,1,2)].')').' '.$NIF_Type[$nif[0]];
        }
    }
    return false;
} //end checkNIFv2()
?>
