/*
 * http://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
 * http://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal
 */
function checkNIF(nif) {
    nif = nif.toUpperCase().replace(/[\s\-]+/g, '');
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
            var uni = num%10;
            sum += (num-uni)/10+uni;
        }
        var c = (10-sum%10)%10;
        if(nif[8]==c || nif[8]=='JABCDEFGHI'[c]) {
            return /^[KLM]/.test(nif)? 'ESP': 'CIF';
        }
    }
    return false;
}
