/**
 * Tuyet Tram DANG NGOC (dntt) - 2001
 * Client TCP
 */

import java.io.IOException ;
import java.io.BufferedReader ;
import java.io.InputStreamReader ;
import java.io.PrintWriter ;
import java.io.IOException ;
import java.net.ConnectException;
import java.net.InetAddress;
import java.net.Socket ;
import java.net.SocketException;
import java.net.SocketTimeoutException;
import java.net.UnknownHostException ;
import java.lang.*;

public class ClientTcp extends Thread{
    public static void main (String argv []) throws IOException {
        Socket socket = null ;
        PrintWriter flux_sortie = null ;
        BufferedReader flux_entree = null ;
        String chaine ;
        int[] port = {9999};
        int iport= 0000;
        boolean connexion = false;
        int securite = 3;
        BufferedReader ip = new BufferedReader ( new InputStreamReader ( System.in)) ;
        InetAddress addr= InetAddress.getLocalHost();
        

        System.out.println("appliquer une adresse ip et un port ou tapez default pour celle par defaut"); 
        
		while(connexion == false ) {
			System.out.println("appliquer une adresse ip");
			String ips= ip.readLine();
			if (ips.equals("default")) {
				ips = "localhost";
			}
			System.out.println("appliquer un port");
			String port1= ip.readLine();
			System.out.println(port1);
			if (port1.equals("default")) {
				iport= 9999 ;
			}else { 
				try {
					iport = Integer.parseInt(port1);
			
			}catch(NumberFormatException e) {
				System.out.println("port non valide port 9999 appliqué");
				iport=9999;
			}
			}
		try {
            // deuxieme argument : le numero de port que l'on contacte
            socket = new Socket (ips, iport) ;
            connexion = true;
            flux_sortie = new PrintWriter (socket.getOutputStream (), true) ;
            flux_entree = new BufferedReader (new InputStreamReader (
                                        socket.getInputStream ())) ;
            socket.setSoTimeout(10*1000);
        } 
        catch (UnknownHostException e) {
            System.err.println ("Hote inconnu veuillez appliquer un ip correcte") ;
            securite-=1;
            if (securite ==0){ System.exit (1);
        	} ;
           
        }catch(ConnectException e) {
        	System.err.println ("port serveur non ouvert") ;
        	 securite-=1;
             if (securite ==0){ System.exit (1);
         	} ;
        	
        }catch(IOException | IllegalArgumentException | SecurityException e)
        {
        	System.err.println(e);
            System.err.println("Hote inconnu\nVérifier que : \n- Le serveur est lancé\n- Le port est compris entre 0 et 65535\n- Le port indiqué est le même que celui du serveur");
            securite-=1;
            if (securite ==0){ System.exit (1);
        	} ;
        }
		
		}
	// L'entree standard
        BufferedReader entree_standard = new BufferedReader ( new InputStreamReader ( System.in)) ;
        chaine= flux_entree.readLine();
        String[] words = chaine.split("/x");
		System.out.println("le serveur a repondu : ");
		for (String word : words){
			System.out.println(word);
		}

	do {
		// on lit ce que l'utilisateur a tape sur l'entree standard
		chaine = entree_standard.readLine () ;
		

		// et on l'envoie au serveur
		flux_sortie.println (chaine) ;
		flux_sortie.flush();
		// on lit ce qu'a envoye le serveur
		if (!chaine.equals("close")) {
		try {
			
			chaine= flux_entree.readLine();}
		catch(SocketException  | SocketTimeoutException e ) {
			System.err.println ("connexion perdu") ;
            System.exit (1) ;
			
		}
		String[] words1 = chaine.split("/x");
		System.out.println("le serveur a repondu : ");
		for (String word : words1){
			System.out.println(word);
		}}
        } while (!chaine.equals("close")) ;

        flux_sortie.close () ;
        flux_entree.close () ;
        entree_standard.close () ;
        socket.close () ;
    }
}
