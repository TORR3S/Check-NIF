import re
from checkNIF import checkNIF

codes='''
89952504X,34492791J,82658777C,08437810F,57754241E,69634991F,51017227F,26687867R,35386964S,72499603S
X9197955W,X1110911B,X6120934J,Y7328372B,Y0599798H,X2868197M,X6110645M,X1192484A,Z8046484P,Y9036522C
K5934711B,L8321265D,M1277951H,K1971813I,L0725393C,M6862729H,K0539665J,L8157591B,M3836112G,K7673912G
H57268492,S2799250B,Q6614401E,J42624288,U02198737,P9424103A,R1199767C,Q4267053I,V93169217,H0015036G
C1197946E,J1459591B,D0535155F,F6646844H,R16201535,G3382989F,C4112279G,U6354966A,G3905259B,R94276268
'''

h='''Type:
    Document code to check it
    's' to check a sample list
    'h' to show this help
    Enter to exit'''
print(h)
code = input('>>>')
while code!='':
    if code=='h': print(h)
    elif code=='s':
        codes = re.sub('\n+',',',codes)
        lcod = codes.split(',')
        for i in range(1,len(lcod)-1):
            print('_'*40+'\n'+lcod[i])
            print(checkNIF(lcod[i]))
    else:
        print(checkNIF(code))
    code = input('>>>')

