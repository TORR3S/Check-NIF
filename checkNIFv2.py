#http://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal
#http://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal

NIF_Type = {
    'A':'Sociedad Anónima',
    'B':'Sociedad de Responsabilidad Limitada',
    'C':'Sociedad Colectiva',
    'D':'Sociedad Comanditaria',
    'E':'Comunidad de Bienes',
    'F':'Sociedad Cooperativa',
    'G':'Asociación o Fundación',
    'H':'Comunidad de Propietarios en Régimen de Propiedad Horizontal',
    'J':'Sociedad Civil, con o sin Personalidad Jurídica',
    'K':'Español menor de 14 años',
    'L':'Español residente en el extranjero sin DNI',
    'M':'NIF que otorga la Agencia Tributaria a extranjeros que no tienen NIE',
    'N':'Entidad Extranjera',
    'P':'Corporación Local',
    'Q':'Organismo Autónomo, Estatal o no, o Asimilado, o Congregación o Institución Religiosa',
    'R':'Congregación o Institución Religiosa (desde 2008, ORDEN EHA/451/2008)',
    'S':'Órgano de la Administración General del Estado o de las Comunidades Autónomas',
    'U':'Unión Temporal de Empresas',
    'V':'Sociedad Agraria de Transformación',
    'W':'Establecimiento permanente de entidad no residente en España',
    'X':'Extranjero identificado por la Policía con un número de identidad de extranjero, NIE con letra "X", asignado hasta el 15 de julio de 2008',
    'Y':'Extranjero identificado por la Policía con un NIE con letra "Y", asignado desde el 16 de julio de 2008 (Orden INT/2058/2008, BOE del 15 de julio)',
    'Z':'Letra "Z" reservada para cuando se agoten los "Y" para Extranjeros identificados por la Policía con un NIE'
}
CIF_Prov = {
    '00':'No Residente',
    '01':'Álava',
    '02':'Albacete',
    '03':'Alicante',
    '53':'Alicante',
    '54':'Alicante',
    '04':'Almería',
    '05':'Ávila',
    '06':'Badajoz',
    '07':'Islas Baleares',
    '57':'Islas Baleares',
    '08':'Barcelona',
    '58':'Barcelona',
    '59':'Barcelona',
    '60':'Barcelona',
    '61':'Barcelona',
    '62':'Barcelona',
    '63':'Barcelona',
    '64':'Barcelona',
    '65':'Barcelona',
    '66':'Barcelona',
    '68':'Barcelona',
    '09':'Burgos',
    '10':'Cáceres',
    '11':'Cádiz',
    '72':'Cádiz',
    '12':'Castellón',
    '13':'Ciudad Real',
    '14':'Córdoba',
    '56':'Córdoba',
    '15':'La Coruña',
    '70':'La Coruña',
    '16':'Cuenca',
    '17':'Gerona',
    '55':'Gerona',
    '67':'Gerona',
    '18':'Granada',
    '19':'Guadalajara',
    '20':'Guipúzcoa',
    '71':'Guipúzcoa',
    '21':'Huelva',
    '22':'Huesca',
    '23':'Jaén',
    '24':'León',
    '25':'Lérida',
    '26':'La Rioja',
    '27':'Lugo',
    '28':'Madrid',
    '78':'Madrid',
    '79':'Madrid',
    '80':'Madrid',
    '81':'Madrid',
    '82':'Madrid',
    '83':'Madrid',
    '84':'Madrid',
    '85':'Madrid',
    '86':'Madrid',
    '87':'Madrid',
    '29':'Málaga',
    '92':'Málaga',
    '93':'Málaga',
    '30':'Murcia',
    '73':'Murcia',
    '31':'Navarra',
    '71':'Navarra',
    '32':'Orense',
    '33':'Asturias',
    '74':'Asturias',
    '34':'Palencia',
    '35':'Las Palmas',
    '76':'Las Palmas',
    '36':'Pontevedra',
    '27':'Pontevedra',
    '94':'Pontevedra',
    '37':'Salamanca',
    '38':'Santa Cruz de Tenerife',
    '75':'Santa Cruz de Tenerife',
    '39':'Cantabria',
    '40':'Segovia',
    '41':'Sevilla',
    '90':'Sevilla',
    '91':'Sevilla',
    '42':'Soria',
    '43':'Tarragona',
    '77':'Tarragona',
    '44':'Teruel',
    '45':'Toledo',
    '46':'Valencia',
    '96':'Valencia',
    '97':'Valencia',
    '98':'Valencia',
    '47':'Valladolid',
    '48':'Vizcaya',
    '95':'Vizcaya',
    '49':'Zamora',
    '50':'Zaragoza',
    '99':'Zaragoza',
    '51':'Ceuta',
    '52':'Melilla'
}

import re
def checkNIF(nif):
    nif = re.sub('[\s\-]+','',nif.upper())
    if re.search('^(\d|[XYZ])\d{7}[A-Z]$',nif):
        num = re.findall('\d+',nif)[0]
        num = int(('2' if nif[0]=='Z' else '1' if nif[0]=='Y' else '0') + num)
        if nif[8]=='TRWAGMYFPDXBNJZSQVHLCKE'[num%23]:
            return 'DNI' if re.search('^\d',nif) else 'NIE: '+NIF_Type[nif[0]]
    elif re.search('^[ABCDEFGHJKLMNPQRSUVW]\d{7}[\dA-J]$',nif):
        sum = 0
        for i in range(1,8):
            num = int(nif[i])<<i%2
            uni = num%10
            sum += int((num-uni)/10+uni)
        c = (10-sum%10)%10
        if (nif[0] in 'KLMNPQRSW' and nif[8]=='JABCDEFGHI'[c]) or (
        nif[0] not in 'KLMNPQRSW' and nif[8]==str(c)):
            return ('ESP:' if re.search('^[KLM]',nif) else 'CIF: ('+CIF_Prov[nif[1:3]]+')')+' '+NIF_Type[nif[0]]
    return False
#end checkNIF()





code = input('Code:')
while code!='':
    print(code)
    print(checkNIF(code))
    code = input('Code:')
