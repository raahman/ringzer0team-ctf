Informazioni:

Struttura password & indizzi:

aaaa-bbbb-cccc-dddd-eeee

1. riga n°33 (impostare breakpoint su questa riga)
    Utilizzando la password aaaa-bbbb-cccc-dddd-eeee viene elaborata e generata questa:
    e :	"aae"
    d :	"bbd"
    c :	"ccc"
    b :	"ddb"
    a :	"eea"

    e paragonata a questa riga n°19

    var ref = {T : "BG8",J : "jep",j : "M2L",K : "L23",H : "r1A"};

    T : "BG8",
    J : "jep",
    j : "M2L",
    K : "L23",
    H : "r1A"

    l'IF di riga n°33 ci impone che la password una volta elaborata sia uguale a questo
    json di riferimento. DP.

    Utilizzando questa password:
    abcd-efgh-ilmn-opqr-stuw

    si ottiene:

    w:bcs
    r:fgo
    n:lmi
    h:pqe
    d:tua

    Quindi:
      a  b  c   d      e   f   g  h       i   l     m  n       o    p   q    r        s    t    u   w
    | 1| 2| 3| 4| - | 5| 6| 7| 8| - | 9|10|11|12| - |13|14|15|16| - |17|18|19|20|

    20 : 2-3-17
    16 : 6-7-13
    12 : 10-11-9
    8 : 14-15-5
    4 : 18-19-1

    Secondo questo schema è possibile ricostruire la password corretta partendo dall'array.

2. Attenzione all'oggetto "ref", nell' debug l'ordine è il seguente:

  H:"r1A"
  J: 	"jep"
  K: "L23"
  T: "BG8"
  j: 	"M2L"

password di test, partendo dal presupposto che sia corretto l'ordine del punto 2.

Lr1j-8jeT-3L2K-pBGJ-AM2H (sbagliata)

rispettando l'ordine dell'array punto 1:

ABGH-3jeK-LM2j-pL2J-8r1T (corretta)

*La password deve*

1. riga n°27/28 - la password deve avere una struttura di questo tipo: a-b-c-d-e
2. riga n°71 - le singole parti devono essere:
    1. diverse da 0
    2. lunghezza diversa da 0
    3. lunghezza deve essere 4
