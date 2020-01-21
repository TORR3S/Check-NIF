function checkNIF(nif) {
    nif = nif.toUpperCase().replace(/[_\W\s]+/g, '');
    if(/^(\d|[XYZ])\d{7}[A-Z]$/.test(nif)) {
        var num = nif.match(/\d+/);
        num = (nif[0]!='Z'? nif[0]!='Y'? 0: 1: 2)+num;
        if(nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[num%23]) {
            return /^\d/.test(nif)? 'DNI': 'NIE';
        }
    }
    else if(/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$/.test(nif)) {
        for(var sum=0,i=1;i<8;++i) {
            var num = nif[i]<<i%2;
            sum += int(num/10)+num%10
        }
        var c = (10-su)%10;
        if( ((/[KLMNPQRSW]/.test(nif[0]) || (nif[1]+nif[2])=='00') && nif[8]=='JABCDEFGHI'[c]) ||
            (/[ABEH]/.test(nif[0]) && nif[8]==c) ||
            (/[CDFGJUV]/.test(nif[0]) && (nif[8]=='JABCDEFGHI'[c] || nif[8]==c)) ) {
            return /^[KLM]/.test(nif)? 'ESP': 'CIF';
        }
    }
    return false;
}