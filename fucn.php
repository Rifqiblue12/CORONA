<? php
### Asli Dari ###
### https: //github.com/osyduck/Gojek-Register###
// ikiganteng
 permintaan fungsi ( $ url , $ token = null , $ data = null , $ pin = null ) {
$ header [] = "Host: api.gojekapi.com" ;
$ header [] = "User-Agent: okhttp / 3.12.1" ;
$ header [] = "Terima: application / json" ;
$ header [] = "Bahasa Terima: id-ID" ;
$ header [] = "Tipe-Konten: application / json; charset = UTF-8" ;
$ header [] = "X-AppVersion: 3.48.2" ; // ubah sesuai clone lu
$ header [] = "X-UniqueId:" . waktu (). "57" . mt_rand ( 1000 , 9999 );
$ header [] = "Koneksi: tetap-hidup" ;
$ header [] = "X-User-Lokal: en_ID" ;
$ header [] = "X-Location: -6.224058,106.877913" ;
$ header [] = "X-Location-Accuracy: 0,0" ;
if ( $ pin ):
$ header [] = "pin: $ pin" ;
    endif ;
if ( $ token ):
$ header [] = "Otorisasi: Bearer $ token" ;
endif ;
$ c = curl_init ( "https://api.gojekapi.com" . $ url );
    curl_setopt ( $ c , CURLOPT_FOLLOWLOCATION , true );
    curl_setopt ( $ c , CURLOPT_SSL_VERIFYPEER , false );
    if ( $ data ):
    curl_setopt ( $ c , CURLOPT_POSTFIELDS , $ data );
    curl_setopt ( $ c , CURLOPT_POST , true );
    endif ;
    curl_setopt ( $ c , CURLOPT_SSL_VERIFYHOST , 0 );
    curl_setopt ( $ c , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt ( $ c , CURLOPT_HEADER , true );
    curl_setopt ( $ c , CURLOPT_HTTPHEADER , $ header );
    $ response = curl_exec ( $ c );
    $ httpcode = curl_getinfo ( $ c );
    if (! $ httpcode )
        return  false ;
    selain itu {
        $ header = substr ( $ response , 0 , curl_getinfo ( $ c , CURLINFO_HEADER_SIZE ));
        $ body    = substr ( $ response , curl_getinfo ( $ c , CURLINFO_HEADER_SIZE ));
    }
    $ json = json_decode ( $ body , true );
    mengembalikan  $ json ;
}
 menyimpan fungsi ( $ nama file , $ konten )
{
    $ save = fopen ( $ filename , "a" );
    fputs ( $ save , "$ content \ r \ n" );
    fclose ( $ save );
}

fungsi  nama ()
    {
    $ ch = curl_init ();
    curl_setopt ( $ ch , CURLOPT_URL , "http://ninjaname.horseridersupply.com/indonesian_name.php" );
    curl_setopt ( $ ch , CURLOPT_SSL_VERIFYPEER , 0 );
    curl_setopt ( $ ch , CURLOPT_SSL_VERIFYHOST , 0 );
    curl_setopt ( $ ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt ( $ ch , CURLOPT_FOLLOWLOCATION , 1 );
    $ ex = curl_exec ( $ ch );

    preg_match_all ( '~ (& bull; (. *?) <br/> & bull;) ~' , $ ex , $ name );
    return  $ name [ 2 ] [ mt_rand ( 0 , 14 )];
    }

 register fungsi ( $ no )
    {
    $ nama = nama ();
    $ email = str_replace ( "" , "" , $ nama ). mt_rand ( 1000 , 9999 );
    $ data = '{"email": "' . $ email . '@ gmail.com", "name": "' . $ nama . '", "phone": "+' . $ no . '", " signed_up_country ":" ID "} ' ;
    $ register = request ( "/ v5 / customers" , "" , $ data );
    if ( $ register [ 'success' ] == 1 )
        {
        kembalikan  $ register [ 'data' ] [ 'otp_token' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ register ));
        return  false ;
        }
    }

    fungsi  masuk ( $ no )
    {

    $ data = '{"phone": "+' . $ no . '"}' ;
    $ register = request ( "/ v4 / customers / login_with_phone" , "" , $ data );
   
    if ( $ register [ 'success' ] == 1 )
        {
        mengembalikan  $ register [ 'data' ] [ 'login_token' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ register ));
        return  false ;
        }
    }

function  veriflogin ( $ otp , $ token )
    {
    $ data = '{"client_name": "gojek: cons: android", "client_secret": "83415d06-ec4e-11e6-a41b-6c40088ab51e", "data": {"otp": "' . $ otp . '" , "otp_token": "' . $ token . '"}, "grant_type": "otp", "scopes": "gojek: pelanggan: transaksi gojek: pelanggan: readonly"} ' ;
    $ verif = permintaan ( "/ v4 / customers / login / verifikasi" , "" , $ data );
    if ( $ verif [ 'success' ] == 1 )
        {
        mengembalikan  $ verif [ 'data' ] [ 'access_token' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ verif ));
        return  false ;
        }
    }
 perubahan fungsi ( $ no )
{
    $ data = '{"email": "' . $ email . '", "name": "' . $ nama . '", "phone": "+' . $ no . '"}' ;
    $ change = request ( "/ v4 / customers" , "" , $ data );
    if ( $ change [ 'success' ] == 1 ) {
        mengembalikan  $ perubahan ;
    }
    selain itu {
        save ( "error_log.txt" , json_encode ( $ change ));
        return  false ;
    }
}
fungsi  verifchange ( $ otp , $ uid )
{
    $ data = '{"id":' . $ uid . ', "phone": "+' . $ no . '", "verifikasiCode": "' . $ otp . '"}' ;
        $ verifchange = request ( "/ v4 / customer / verifikasiUpdateProfil" , "" , $ data );
        if ( $ verifchange [ 'success' ] == 1 ) {
            mengembalikan  $ verifchange ;
        }
        selain itu {
            save ( "error_log.txt" , json_encode ( $ verifchange ));
        return  false ;
        }
}
fungsi  verif ( $ otp , $ token )
    {
    $ data = '{"client_name": "gojek: cons: android", "data": {"otp": "' . $ otp . '", "otp_token": "' . $ token . '"}, " client_secret ":" 83415d06-ec4e-11e6-a41b-6c40088ab51e "} ' ;
    $ verif = permintaan ( "/ v5 / pelanggan / telepon / verifikasi" , "" , $ data );
    if ( $ verif [ 'success' ] == 1 )
        {
		$ h = fopen ( "accgojek2.txt" , "a" );
		fwrite ( $ h , json_encode ( $ verif ). "\ n" );
		fclose ( $ h );
        mengembalikan  $ verif [ 'data' ] [ 'access_token' ];
        }
      lain
        {
       save ( "error_log.txt" , json_encode ( $ verif ));
        return  false ;
        }
    }

 klaim fungsi ( $ token , $ voc )
    {
    $ data = '{"promo_code": "' . $ voc . '"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }

    function  claim1 ( $ token )
    {
    $ data = '{"promo_code": "GOFOODSANTAI11"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }
    function  claim2 ( $ token )
    {
    $ data = '{"promo_code": "GOFOODSANTAI08"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }
      naik fungsi ( $ token )
    {
    $ data = '{"promo_code": "COBAINGOJEK"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
          return  false ;
        }
    }
     function  cekvocer ( $ token )
    {
    $ data = '{"promo_code": "AYOCOBAGOJEK"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }
     function  pengen ( $ token )
    {
    $ data = '{"promo_code": "G-7RCBDYN"}' ;    
    $ klaim = permintaan ( "/ promosi-pergi / v1 / promosi / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }

function  reff ( $ token )
    {
    $ data = '{"referral_code": "G-75SR565"}' ;    
    $ klaim = permintaan ( "/ customer_referrals / v1 / kampanye / pendaftaran" , $ token , $ data );
    if ( $ claim [ 'success' ] == 1 )
        {
        return  $ claim [ 'data' ] [ 'message' ];
        }
      lain
        {
      save ( "error_log.txt" , json_encode ( $ claim ));
        return  false ;
        }
    }
	
	function  cekno ( $ no )
    {
	$ token = '5993944e-50c7-4f93-bb81-2f2acb206c7a' ;
    $ claim = request ( "/ wallet / qr-code? phone_number =% 2B" . $ no , $ token , null );
    if ( $ claim [ 'data' ] == null )
        {
		kembali  benar ;
        }
      lain
        {
      return  false ;
        }
    }
	 makanan fungsi ( $ token )
	{
	$ klaim = permintaan ( "/ v2 / pelanggan / kartu / makanan" , $ token , null );
$ food = json_decode ( json_encode ( $ claim ));
foreach ( $ food -> data -> kartu  sebagai  $ item ) {
if ( $ item -> content -> action [ 0 ] -> description == "Promo 1" ) {
$ food = $ item -> konten -> tindakan [ 0 ] -> deep_link ;
$ food = meledak ( "code =" , trim ( $ food ));
$ food = trim ( $ food [ 1 ]);
mengembalikan  $ makanan ;
	}
	}
	}
?>
