function checkNIF(nif) {
    nif = nif.toUpperCase().replace(/[_\W\s]+/g, '');
    if(/^(\d|[XYZ])\d{7}[A-Z]$/.test(nif)) {
        var nu = nif.match(/\d+/);
        nu = (nif[0]!='Z'? nif[0]!='Y'? 0: 1: 2)+nu;
        if(nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[nu%23]) {
            return /^\d/.test(nif)? 'DNI': 'NIE';
        }
    }
    else if(/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$/.test(nif)) {
        for(var su=0,i=1;i<8;++i) {
            var nu = nif[i]<<i%2;
            var un = nu%10;
            su += (nu-un)/10+un;
        }
        var c = (10-su)%10;
        if((/[KLMNPQRSW]/.test(nif[0]) && nif[8]=='JABCDEFGHI'[c] ) ||
          (!/[KLMNPQRSW]/.test(nif[0]) && nif[8]==c)) {
            return /^[KLM]/.test(nif)? 'ESP': 'CIF';
        }
    }
    return false;
}