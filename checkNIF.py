import re
def checkNIF(nif):
    nif = re.sub('[_\W\s]+','',nif.upper())
    if re.search('^(\d|[XYZ])\d{7}[A-Z]$',nif):
        nu = re.findall('\d+',nif)[0]
        nu = int(('2' if nif[0]=='Z' else '1' if nif[0]=='Y' else '0') + nu)
        if nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[nu%23]:
            return 'DNI' if re.search('^\d',nif) else 'NIE'
    elif re.search('^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$',nif):
        su = 0;
        for i in range(1,8):
            nu = int(nif[i])<<i%2
            su += nu//10+nu%10
        c = (10-su)%10
        if (nif[0] in 'KLMNPQRSW' and nif[8]=='JABCDEFGHI'[c]) or (
        nif[0] not in 'KLMNPQRSW' and nif[8]==str(c)):
            return 'ESP' if re.search('^[KLM]',nif) else 'CIF'
    return False

