# PHP interface

This needs hashcat to be operational, meaning NVIDIA drivers etc; it uses `tsp` for queuing ( https://manpages.ubuntu.com/manpages/xenial/man1/tsp.1.html - but I installed Ubuntu/Debian .deb onto kali fine, as well as on Ubuntu ).

Also, apache2 and PHP need to be present, and then you need to customise inc.php.

The work dir will need to exist and be writable:  `mkdir /var/hashcrack && chown www-data /var/hashcrack`

bokeh is used for graphs: `pip3 install bokeh` 

It will be a pain to get it running on Windows, but then Windows needs rebooting too often to be of much use as a multi-user password cracking box. 

# How it works

This UI was written in a hurry and just really gives a functional front end onto the main hashcrack.

submit.php provides the entry screen which takes either a file, or a file and a bunch of other parameters to run hashcat with.  When the 'go' button is pressed, a test hashcrack command is run to find out what type of hash we think we've got.

upload.php takes the uploaded file and does a dry run with hashcrack.py to see what the executed command would be:

	   python3 hashcrack.py -Z -i $dest_path | grep RUN: | sed 's/RUN://

This command is then queued with 'tsp', and identified by the job ID, which is just the sha256 hash of the uploaded file itself. 

## Queuing

This is done with the ubuntu utility 'tsp'. For example, the queue is queried with the following shocking code:

    print "<pre>Running : ".`tsp -l | grep running | wc -l`."</pre>";
    print "<pre>Queued:   ".`tsp -l | grep queued | wc -l`."</pre>";
    print "<pre>Finished: ".`tsp -l | grep finished | wc -l`."</pre>";
