#https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
#https://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal

import re
def checkNIF(nif):
    nif = re.sub('[\W\s]+','',nif.upper())
    if re.search('^(\d|[XYZ])\d{7}[A-Z]$',nif):
        num = re.findall('\d+',nif)[0]
        num = int(('2' if nif[0]=='Z' else '1' if nif[0]=='Y' else '0') + num)
        if nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[num%23]:
            return 'DNI' if re.search('^\d',nif) else 'NIE'
    elif re.search('^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$',nif):
        sum = 0
        for i in range(1,8):
            num = int(nif[i])<<i%2
            uni = num%10
            sum += int((num-uni)/10+uni)
        c = (10-sum%10)%10
        if (nif[0] in 'KLMNPQRSW' and nif[8]=='JABCDEFGHI'[c]) or (
            nif[0] not in 'KLMNPQRSW' and nif[8]==str(c)):
            return 'ESP' if re.search('^[KLM]',nif) else 'CIF'
    return False
#end checkNIF()
