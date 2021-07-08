<?php
function regmap($hash)
{

if (preg_match('/(^|:)[A-Fa-f0-9]{32}$/',$hash)==1) { return "0:md5"; }
if (preg_match('/(^|:)\$1\$/',$hash)==1) { return "500:md5crypt"; }
if (preg_match('/(^|:)\$krb5tgs\$23\$/',$hash)==1) { return "13100:kerberos ticket type 13100"; }
if (preg_match('/(^|:)\$krb5tgs\$17\$/',$hash)==1) { return "19600:kerberos ticket type 19600"; }
if (preg_match('/(^|:)\$krb5tgs\$18\$/',$hash)==1) { return "19700:kerberos ticket type 19700"; }
if (preg_match('/(^|:)\$krb5pa\$17\$/',$hash)==1) { return "19800:kerberos ticket type 19800"; }
if (preg_match('/(^|:)\$krb5pa\$18\$/',$hash)==1) { return "19900:kerberos ticket type 19900"; }
if (preg_match('/(^|:)\$krb5asrep\$23\$/',$hash)==1) { return "18200:kerberos ticket type 18200"; }
if (preg_match('/(^|:)\$krb5pa\$23\$/',$hash)==1) { return "7500:kerberos type 7500"; }
if (preg_match('/(^|:)\$P\$/',$hash)==1) { return "400:phpass"; }
if (preg_match('/(^|:)\$H\$/',$hash)==1) { return "400:phpass"; }
if (preg_match('/(^|:)\$8\$/',$hash)==1) { return "9200:Cisco type 8 (pbkdf2-sha256)"; }
if (preg_match('/(^|:)\$9\$/',$hash)==1) { return "9300:Cisco type 9 (scrypt)"; }
if (preg_match('/(^|:)sha1\$/',$hash)==1) { return "124:Django SHA1"; }
if (preg_match('/(^|:)\$S\$/',$hash)==1) { return "7900:Drupal"; }
if (preg_match('/(^|:)\$PHPS\$/',$hash)==1) { return "2612:PHPS"; }
if (preg_match('/(^|:)(A|a)dministrator:500:[A-Fa-f0-9]{32}:[A-Fa-f0-9]{32}:/',$hash)==1) { return "pwdump:pwdump"; }
if (preg_match('/(^|:)\d+:[A-Fa-f0-9]{32}:[A-Fa-f0-9]{32}:/',$hash)==1) { return "pwdump:pwdump"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:[A-Za-z0-9_]{1,10}$/',$hash)==1) { return "12:postgres"; }
if (preg_match('/(^|:)\$2(a|b|y)/',$hash)==1) { return "3200:bcrypt"; }
if (preg_match('/(^|:)sha512:/',$hash)==1) { return "12100:Cisco sha512 pbkdf2"; }
if (preg_match('/(^|:)\$5\$/',$hash)==1) { return "7400:sha256crypt"; }
if (preg_match('/(^|:)\$6\$/',$hash)==1) { return "1800:sha512crypt"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:[A-Fa-f0-9]{13,14}$/',$hash)==1) { return "1100:DCC / ms cache"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:[A-Fa-f0-9]{6}$/',$hash)==1) { return "2611:vBulletin (2611)"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:.{5}$/',$hash)==1) { return "2811:IPB (2811)"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:[A-Fa-f0-9]{49}$/',$hash)==1) { return "8100:Citrix netscaler"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{126,130}:[A-Fa-f0-9]{40}$/',$hash)==1) { return "7300:IPMI2"; }
if (preg_match('/(^|:)[A-Za-z0-9\./]{43}$/',$hash)==1) { return "5700:Cisco type 4"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{16}:[A-Fa-f0-9]{32}:[A-Fa-f0-9]{100}/',$hash)==1) { return "5600:NetLMv2"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{32}:[A-Fa-f0-9]{210}$/',$hash)==1) { return "5600:NetLMv2"; }
if (preg_match('/(^|:)[a-fA-f0-9]{48}:[A-fa-f0-9]{48}:/',$hash)==1) { return "5500:NetLMv1"; }
if (preg_match('/(^|:)[A-Za-z0-9\.\/]{16}$/',$hash)==1) { return "2400:Cisco ASA"; }
if (preg_match('/(^|:)[A-Za-z0-9\.\/]{13}$/',$hash)==1) { return "1500:descrypt"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{40}$/',$hash)==1) { return "100:SHA1"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{64}$/',$hash)==1) { return "1400:SHA256"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{96}$/',$hash)==1) { return "10800:SHA384"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{128}$/',$hash)==1) { return "1700:SHA512"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{786}/',$hash)==1) { return "2500:WPA/WPA2"; }
if (preg_match('/(^|:)\$apr1\$/',$hash)==1) { return "1600:apache MD5"; }
if (preg_match('/(^|:)\$DCC2/',$hash)==1) { return "2100:DCC2 / mscache2"; }
if (preg_match('/(^|:)\{SHA\}/',$hash)==1) { return "101:nsldap SHA1"; }
if (preg_match('/(^|:)\{SSHA256\}/',$hash)==1) { return "1411:ldap SHA256"; }
if (preg_match('/(^|:)\{SSHA512\}/',$hash)==1) { return "1711:ldap SHA512"; }
if (preg_match('/(^|:)\{SSHA\}/',$hash)==1) { return "111:ldap SSHA1"; }
if (preg_match('/(^|:)0x[A-Fa-f0-9]{52}$/',$hash)==1) { return "132:MSSQL2005"; }
if (preg_match('/(^|:)0x[A-Fa-f0-9]{92}$/',$hash)==1) { return "131:MSSQL2000"; }
if (preg_match('/(^|:)0x0200/',$hash)==1) { return "1731:MSSQL2012+"; }
if (preg_match('/(^|:)\{smd5\}/',$hash)==1) { return "6300:AIX smd5"; }
if (preg_match('/(^|:)\{ssha1\}/',$hash)==1) { return "6700:AIX ssha1"; }
if (preg_match('/(^|:)\{ssha256\}/',$hash)==1) { return "6400:AIX ssha256"; }
if (preg_match('/(^|:)\{ssha512\}/',$hash)==1) { return "6500:AIX ssha512"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{40}$/',$hash)==1) { return "8100:MySQL5"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{60}$/',$hash)==1) { return "112:Oracle (112) - but it needs a hash between the first 40 and last 20 for some reason"; }
if (preg_match('/(^|:)[A-Fa-f0-9]{40}:[A-Fa-f0-9]{20}$/',$hash)==1) { return "112:Oracle (112)"; }
if (preg_match('/^\$cloudkeychain\$/',$hash)==1) { return "6600:1Password"; }
if (preg_match('/(^|:)[a-f0-9]{32}\*[a-f0-9]{12}\*[a-f0-9]{12}\*[a-f0-9]{8,20}/',$hash)==1) { return "16800:WPA PMKID"; }
if (preg_match('/(^|:)grub.pbkdf2.sha512/',$hash)==1) { return "7200:grub"; }
if (preg_match('/(^|:)[A-Z0-9]+\$[A-F0-9]{40}/',$hash)==1) { return "7800:SAP CODVN F/G (PASSCODE)"; }
if (preg_match('/(^|:)[A-Z0-9]+\$[A-F0-9]{16}/',$hash)==1) { return "7700:SAP CODVN B (BCODE)"; }
if (preg_match('/(^|:)[A-F0-9]{160}/',$hash)==1) { return "12300:Oracle T"; }
if (preg_match('/(^|:)pbkdf2_sha256\$/',$hash)==1) { return "10000:Django"; }
if (preg_match('/\$gpg\$/',$hash)==1) { return "gpg-opencl:GPG"; }
if (preg_match('/\$zip2\$/',$hash)==1) { return "13600:ZIP"; }
if (preg_match('/(^|:)md5:1000:/',$hash)==1) { return "11900:pbkdf2-hmac-md5"; }
if (preg_match('/(^|:)sha1:1000:/',$hash)==1) { return "12000:pbkdf2-hmac-sha1"; }
if (preg_match('/(^|:)sha256:1000:/',$hash)==1) { return "10900:pbkdf2-hmac-sha256"; }
if (preg_match('/(^|:)sha512:1000:/',$hash)==1) { return "12100:pbkdf2-hmac-sha512"; }
if (preg_match('/\$office\$\*2013/',$hash)==1) { return "9600:office-2013"; }
if (preg_match('/\$office\$\*2007/',$hash)==1) { return "9400:office-2007"; }
if (preg_match('/\$office\$\*2010/',$hash)==1) { return "9500:office-2010"; }
if (preg_match('/\$oldoffice\$\*0/',$hash)==1) { return "9700:oldoffice-0"; }
if (preg_match('/\$oldoffice\$\*3/',$hash)==1) { return "9800:oldoffice-3"; }
if (preg_match('/\$sha1\$/',$hash)==1) { return "15100:juniper-sha1crypt"; }
if (preg_match('/^HCPX.+HCPX/',$hash)==1) { return "2501:wpa-pmk"; }
if (preg_match('/^HCPX/',$hash)==1) { return "2500:wpa-psk"; }
if (preg_match('/(^|:)[A-Za-z0-9\=\/\+]{40,48}/',$hash)==1) { return "7000:fortigateb"; }
if (preg_match('/(^|:)eyJ/',$hash)==1) { return "16500:JWT"; }
if (preg_match('/(^|:)\$B\$/',$hash)==1) { return "3711:mediawiki-B"; }
if (preg_match('/(^|:)\$keychain\$/',$hash)==1) { return "23100:apple-keychain"; }
if (preg_match('/(^|:)\$pbkdf2-sha512\$/',$hash)==1) { return "20200:python-passlib-pbkdf2-sha512"; }
if (preg_match('/(^|:)\$pbkdf2-sha256\$/',$hash)==1) { return "20300:python-passlib-pbkdf2-sha256"; }
if (preg_match('/(^|:)\$pbkdf2\$/',$hash)==1) { return "20400:python-passlib-pbkdf2-sha1"; }
if (preg_match('/(^|:)\$jksprivk\$/',$hash)==1) { return "15500:JavaKeyStore"; }

return "99999:NOMATCH";

}
?>
