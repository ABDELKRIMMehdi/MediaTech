import socket
import psycopg2
import datetime

def verifclient(connection):
    connection.settimeout(1000)
    try:
        string = connection.recv(1024)

    except(connection.timeout):
        print("le client a mis trop de temps a repondre")
        string = "-q"
    except:
        print("client deconnecter")
        string = "-q"

    return string

def supdecode(var):
    try:
        if var == "-q":
            return var
        else:
            var = var.decode("utf-8")
            var = var.replace("\r\n", "")
            var = var.replace("\n", "")

    except Exception as e:
        print("les valeur instauré par le client ne sont pas compatible en utf8 ou trop longue ", e)
        var = " valeur non valide"

    return var


def split_time():
    today = datetime.datetime.now()
    todayear = today.strftime("%Y")
    todaymonth = today.strftime("%m")
    todayday = today.strftime("%d")
    if int(todayday) >= 30:
        todayday = str(0)
        todaymonth = str(int(todaymonth) + 1)
        if int(todaymonth) >= 12:
            todayear = int(todayear) + 1
            todayear = str(todayear)
            todaymonth = "01"
    todayday = str(int(todayday) + 1)
    today = todayear + "-" + todaymonth + "-" + todayday

    if int(todaymonth) >= 12:
        todayear = int(todayear) + 1
        todayear = str(todayear)
        todaymonth = "01"
    else:
        todaymonth = str(int(todaymonth) + 1)

    datefin = todayear + "-" + todaymonth + "-" + todayday
    return today, datefin


def split_np(np):
    index = np.find(",")
    indexmax = len(np)
    prenom = np[0:index]
    nom = np[index + 2:indexmax]
    nom = nom.replace("\r\n", "")

    return nom, prenom


def livre_disponibilite():
    # establishing the connection
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    cursor = conn.cursor()
    query = f"SELECT titre FROM \"public\".\"Oeuvre\" WHERE \"disponibilite\" ='TRUE' ORDER BY \"titre\";"
    print(query)
    query.replace("\r\n", "")
    # Executing an MYSQL function using the execute() method
    cursor.execute(query)

    # Fetch a single row using fetchall() method.
    data = cursor.fetchall()
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    for x in range(len(characters)):
        string = string.replace(characters[x], "")

    string = "les oeuvres disponible sont : " + string[:-1]

    # Closing the connection
    conn.close()
    return string


def identifier(idc):
    # establishing the connection
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    cursor = conn.cursor()

    query = f"SELECT nom,prenom FROM \"public\".\"Client\" Where \"id_C\" ='{idc}' ;"
    query = query.replace("\r\n", "")

    print(query)
    # Executing an MYSQL function using the execute() method
    cursor.execute(query)

    # Fetch  rows using fetchall() method.
    data = cursor.fetchall()
    print("la chaine " + str(data[0]))
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    print("la chaine " + string)
    for x in range(len(characters)):
        string = string.replace(characters[x], "")

    # Closing the connection
    conn.close()
    return string


def location(idc, nom_oeuvre):
    # establishing the connection
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")
    conn.autocommit = True
    # Creating a cursor object using the cursor() method
    cursor = conn.cursor()
    date = split_time()
    print(nom_oeuvre)

    first_query = f"SELECT \"id_0\",\"NomSection\" FROM \"public\".\"Oeuvre\" Where \"titre\" ='{nom_oeuvre}' AND \"disponibilite\" ='TRUE' ;"
    first_query = first_query.replace("\r\n", "")
    cursor.execute(first_query)
    data = cursor.fetchall()
    print("la chaine " + str(data[0]))
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    print("la chaine " + string)
    for x in range(len(characters)):
        string = string.replace(characters[x], "")
    info = split_np(string)
    entite = info[1].replace('', "")

    idc = idc.replace("\r\n", "")
    query = f"INSERT INTO public.\"Louer\" (\"dateDebut-L\",\"dateFin_L\",\"idC\",\"idO\") VALUES (\'{date[0]}\', \'{date[1]}\',\'{idc}\',\'{entite}\');"
    query = query.replace("\r\n", "")
    cursor.execute(query)
    Lquery = f"UPDATE \"Oeuvre\" SET \"stock\"=\"stock\"-1 WHERE \"NomSection\" = '{info[0]}' AND \"id_0\" = '{entite}';"
    Lquery = Lquery.replace("\r\n", "")
    cursor.execute(Lquery)
    # Closing the connectio0
    conn.close()
    return date[1]


def affichage_location(idc):
    # establishing the connection
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    cursor = conn.cursor()
    query = f"SELECT \"idO\" FROM \"public\".\"Louer\" Where \"idC\" ='{idc}';"
    query = query.replace("\r\n", "")
    # Executing an MYSQL function using the execute() method
    cursor.execute(query)

    # Fetch a single row using fetchall() method.
    data = cursor.fetchall()
    print(data)
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    for x in range(len(characters)):
        string = string.replace(characters[x], "")
    print(string)
    string = "voici vos locations selectionner celle que vous voulez: " + string[:-1]

    # Closing the connection
    conn.close()
    return string


def message_to_client(m):
    return m + "\r\n"


def bienvenue():
    message = "Bienvenue sur le serveur de la mediaTech voici les differentes fonctions disponible " + "/x " \
                                                                                                       "-h: aide pour voir les touches actuel /x " \
                                                                                                       "-ip: identification ip /x " \
                                                                                                       "-r: reservation d'une salle  /x " \
                                                                                                       "-l: livre disponible par type /x " \
                                                                                                       "-q: terminer echange /x " \
                                                                                                       "-d: identification sur la bd /x " \
                                                                                                       "-j: location de jeux ou livres/x " \
                                                                                                       "-c: prolongation d'une location /x "
    message = message_to_client(message)
    return message


def newfinaldate(entite):
    print(entite[0:5])
    todayear = int(entite[0:5].replace(",", ""))
    todaymonth = int(entite[5:8].replace(",", ""))
    todayday = int(entite[8:].replace(",", ""))
    print(todayday, todayear, todaymonth)
    if todayday >= 30:
        todayday = str(0)
        todaymonth = str(todaymonth + 1)
        if todaymonth >= "12":
            todayear = todayear + 1
            todayear = todayear
            todaymonth = "01"
    todayday = "28"
    today = str(todayear) + "-" + str(todaymonth) + "-" + str(todayday)

    if int(todaymonth) >= 12:
        todayear = int(todayear) + 1
        todayear = str(todayear)
        todaymonth = "01"
    else:
        todaymonth = str(int(todaymonth) + 1)

    datefin = str(todayear) + "-" + str(todaymonth) + "-" + str(todayday)
    return datefin


def affiche_privatesection():
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    cursor = conn.cursor()
    query = f"SELECT \"NomSection\" FROM \"public\".\"privé\" Where \"disponibilite\" = 'TRUE';"
    query = query.replace("\r\n", "")
    cursor.execute(query)
    data = cursor.fetchall()
    print("la chaine " + str(data[0]))
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    print("la chaine " + string)
    for x in range(len(characters)):
        string = string.replace(characters[x], "")
    return string


def renouvellement_abonnement(idc, nom_oeuvre):
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    conn.commit()
    cursor = conn.cursor()
    idc = idc.replace("\r\n", "")
    query = f"SELECT \"dateFin_L\",\"idO\" FROM \"public\".\"Louer\" Where \"idC\" ='{idc}' AND \"idO\"= '{nom_oeuvre}';"
    query = query.replace("\r\n", "")
    cursor.execute(query)
    data = cursor.fetchall()
    print("la chaine " + str(data[0]))
    string = ""
    for i in range(len(data)):
        string += str(data[i])
    characters = "(')"
    print("la chaine " + string)
    for x in range(len(characters)):
        string = string.replace(characters[x], "")

    entite = string[13:25]
    id0 = string[25:].replace('', "")
    id0 = id0.replace(")", "")
    id0 = id0.replace(" ", "")
    id0 = id0.replace(",", "")
    print("id0")
    entite = entite.replace("\r\n", "")
    fn = newfinaldate(entite)
    print(fn)
    fb = split_time()
    fb = fb[0]
    query = f"UPDATE \"Louer\" SET \"dateDebut-L\"=\'{fb}\',\"dateFin_L\"=\'{fn}\' WHERE \"idC\" = '{idc}' AND \"idO\" = '{id0}';"
    query = query.replace("\r\n", "")
    print(query)
    # Executing an MYSQL function using the execute() method
    cursor.execute(query)
    conn.commit()
    conn.close()
    return fn


def reservation_salle(debut, fin, idc, string):
    conn = psycopg2.connect(
        host="postgresql-unten95.alwaysdata.net",
        database="unten95_2_mediateque",
        user="unten95",
        password="Bianca95800")

    # Creating a cursor object using the cursor() method
    conn.autocommit = True
    cursor = conn.cursor()
    idc = idc.replace("\r\n", "")
    fin = fin.replace("\r\n", "")
    debut = debut.replace("\r\n", "")
    query = f"INSERT INTO public.\"Reserver\" (\"idC\",\"dateDebRes\",\"dateFinRes\",\"NomSection\") VALUES (\'{idc}\',\'{debut}\',\'{fin}\',\'{string}\');"
    query = query.replace("\r\n", "")
    cursor.execute(query)

    query = f"SELECT \"id_SP\" FROM \"Reserver\" NATURAL JOIN \"privé\" WHERE \"idC\"=\'{idc}\';"
    query = query.replace("\r\n", "")
    cursor.execute(query)

    data = cursor.fetchall()
    print("la chaine " + str(data[0]))
    string = ""
    for i in range(len(data)):
        string = str(data[i])
    characters = "(', )"
    print("la chaine " + string)
    for x in range(len(characters)):
        string = string.replace(characters[x], "")
    print(string)
    squery = f"UPDATE \"privé\" SET \"disponibilite\"='FALSE' WHERE \"id_SP\" = '{string}';"
    squery = squery.replace("\r\n", "")
    cursor.execute(squery)
    conn.commit()
    conn.close()


def serveur_program():
    global idClient, nom, prenom
    idClient, nom, prenom = "", "", ""
    connect= True
    pb=9999
    lcl='localhost'

    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.settimeout((30))
    ip=input("choisissez une adresse ip")

    port=input("choisissez un port")

    try:
        s.bind((ip,int(port)))

    except (socket.error, OverflowError ,TypeError,ValueError) as e:
        print(str(e))
        print("L'ip du serveur ou le numero de port est incorret attribution par defaut")

    try:
        s.bind(('localhost', 9999))
        print(s)
    except (socket.error, OverflowError) as e:
        print(str(e))
        print("L'ip du serveur ou le numero de port est incorret")


    print("attente de connexion client...")
    s.listen(1)
    conn, addr = s.accept()
    print(f"socket crée j'ecoute {addr}")
    s = bytes(bienvenue(), "utf-8")
    conn.send(bytes(bienvenue(), "utf-8"))

    while connect==True:
        try:
            string = verifclient(conn)
            string = supdecode(string)
            print('Received from client : ' + string)
            string = string.replace("\r\n", "")
            string = string.replace("\n", "")

            if string == "-q":
                print("server close")
                mess = "close"
                conn.send(bytes(mess, "utf-8"))
                break
            elif string == "-h":
                conn.send(bytes(bienvenue(), "utf-8"))

            elif string == "-ip":
                try:
                    identification = "votre adresse ipv4 " + addr[0] + " votre port " + str(addr[1])
                    identification = message_to_client(identification)
                except:
                    identification = "impossible de lire votre adresse ip quelle dommage"
                conn.send(bytes(identification, "utf-8"))

            elif string == "-l":
                try:
                    mess = livre_disponibilite()
                except:

                    mess = "mince il n'y a plus d'oeuvre disponible"

                conn.send(bytes(message_to_client(mess), "utf-8"))

            elif string == "-d":

                mess = "identifiez vous avec votre idClient:"
                conn.send(bytes(message_to_client(mess), "utf-8"))
                string = conn.recv(1024)

                idclient = supdecode(string)

                print('Received from client : ' + idclient)
                idClient = idclient
                try:
                    clt = identifier(idclient)
                    nom, prenom = split_np(clt)
                    client = message_to_client("bonjour: " + nom + " " + prenom)
                except:
                    client = message_to_client("bonjour: votre id n'est pas correcte ")

                conn.send(bytes(client, "utf-8"))

            elif string == "-j":
                if idClient == "":
                    mess = "vous ne vous etes pas identifier utilisez -d pour vous identifier:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                else:
                    mess = "le nom de l'oeuvre que vous voulez emprunter:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                    string = verifclient(conn)
                    noeuvre = supdecode(string)
                    try:
                        date = location(idClient, noeuvre)
                        client = message_to_client("votre oeuvre est en location jusqu'au : " + date)
                    except:
                        client = message_to_client(
                            "nom de l'oeuvre non correcte ou alors l'oeuvre est deja en votre possetion")

                    conn.send(bytes(client, "utf-8"))

            elif string == "-c":
                if idClient == "":
                    mess = "vous ne vous etes pas identifier utilisez -d pour vous identifier:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                else:

                    conn.send(bytes(message_to_client(affichage_location(idClient)), "utf-8"))
                    string = verifclient(conn)
                    noeuvre = supdecode(string)
                    try:

                        date = renouvellement_abonnement(idClient, noeuvre)
                        mess = "votre oeuvre est en location jusqu'au : " + str(date)
                    except:
                        mess = " votre oeuvre n'existe pas "

                    conn.send(bytes(message_to_client(mess), "utf-8"))

            elif string == "-r":
                if idClient == "":
                    mess = "vous ne vous etes pas identifier utilisez -d pour vous identifier:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                else:
                    mess = "la date de reservation sous la forme AAAA-MM-JJ:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                    debut = conn.recv(1024)
                    debut = supdecode(debut)
                    debut = debut.replace("\r\n", "")
                    debut = debut.replace("\n", "")

                    mess = "la date de fin de reservation sous la forme AAAA-MM-JJ:"
                    conn.send(bytes(message_to_client(mess), "utf-8"))
                    fin = conn.recv(1024)
                    fin = supdecode(fin)
                    fin = fin.replace("\r\n", "")
                    fin = fin.replace("\n", "")

                    print(fin)
                    try:
                        data = affiche_privatesection()
                        mess = "choisissez parmis ses sections \"jv\" pour salle de jeux \"bi\" pour bibliotheque et \"vi\" pour videotheque: " + data
                    except:
                        mess = "il n'y a pas de section privée"

                    conn.send(bytes(message_to_client(mess), "utf-8"))
                    string = verifclient(conn)
                    string = supdecode(string)
                    string = string.replace("\r\n", "")
                    string = string.replace("\n", "")
                    print(string)
                    try:
                        reservation_salle(debut, fin, idClient, string)
                        mess = "salle en reservation du " + str(debut) + " au " + str(fin)
                    except:
                        mess = "date incorrecte"

                    conn.send(bytes(message_to_client(mess), "utf-8"))
            else:
                mess = "commande non reconnu tapez -h pour de l'aide"
                conn.send(bytes(message_to_client(mess), "utf-8"))
        except:
            print("deconnexion client")
            connect=False

    conn.close()


if __name__ == '__main__':
    serveur_program()
