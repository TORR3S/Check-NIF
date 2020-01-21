import re
def checkNIF(nif):
    nif = re.sub('[_\W\s]+','',nif.upper())
    if re.search('^(\d|[XYZ])\d{7}[A-Z]$',nif):
        num = re.findall('\d+',nif)[0]
        num = int(('2' if nif[0]=='Z' else '1' if nif[0]=='Y' else '0')+num)
        if nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[num%23]:
            return 'DNI' if re.search('^\d',nif) else 'NIE'
    elif re.search('^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$',nif):
        sum = 0;
        for i in range(1,8):
            num = int(nif[i])<<i%2
            sum += num//10+num%10
        c = (10-sum)%10
        if(((nif[0] in 'KLMNPQRSW' or nif[1:3]=='00') and nif[8]=='JABCDEFGHI'[c]) or
            (nif[0] in 'ABEH' and nif[8]==str(c)) or
            (nif[0] in 'CDFGJUV' and (nif[8]=='JABCDEFGHI'[c] or nif[8]==str(c))) ):
            return 'ESP' if re.search('^[KLM]',nif) else 'CIF'
    return False
