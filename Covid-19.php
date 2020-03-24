<? php

error_reporting ( 0 );
termasuk ( "func.php" );
echo  "\ e GOJEK VERSION 1.7.1 \ n" ;
echo  "\ e SCRIPT GOJEK AUTO REGISTER + AUTO CLAIM VOUCHER \ n" ;
gema  "\ n" ;
nggak:
echo  "\ e [?] Masukkan Nomor HP Anda:" ;
$ nggak = trim ( fgets ( STDIN ));
$ cek = cekno ( $ nggak );
if ( $ cek == false )
    {
    echo  "\ e [x] Nomor Telah Terdaftar \ n" ;
			goto nggak;
    }
  lain
    {
echo  "\ e [!] Siapkan OTPmu \ n" ;
tidur ( 5 );
$ register = register ( $ nggak );
if ( $ register == false )
    {
    echo  "\ e [x] Gagal Dapatkan OTP! \ n" ;
    }
  lain
    {
    otp:
    echo  "\ e [!] Masukkan Kode Verifikasi (OTP):" ;
    $ otp = trim ( fgets ( STDIN ));
    $ verif = verif ( $ otp , $ register );
    if ( $ verif == false )
        {
        echo  "\ e [x] Kode Verifikasi Salah \ n" ;
        pergi otp;
        }
      lain
        {
		$ h = fopen ( "newgojek.txt" , "a" );
		fwrite ( $ h , json_encode ( array ( 'token' => $ verif , 'voc' => 'gofood gak ada' )). "\ n" );
		fclose ( $ h );
                echo  "\ e [!] Mencoba menukarkan Reff: G-75SR565! \ n" ;
                tidur ( 3 );
            $ klaim = reff ( $ verif );
            if ( $ claim == false ) {
            echo  "\ e [!] Gagal Klaim Voucher, Coba Klaim Secara Manual \ n" ;
            } lain {
                gema  "\ e [+]" . $ klaim . "\ n" ;
            }
    }
    }
    }


?>
