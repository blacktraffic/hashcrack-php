# PHP interface

This needs hashcat to be operational; it uses `tsp` for queuing ( https://manpages.ubuntu.com/manpages/xenial/man1/tsp.1.html - but I installed Ubuntu/Debian .deb onto kali fine, as well as on Ubuntu ).

Also, apache2 and PHP need to be present, and then you need to customise inc.php.

The work dir will need to exist and be writable:  `mkdir /var/hashcrack && chown www-data /var/hashcrack`

bokeh is used for graphs: `pip3 install bokeh` 

