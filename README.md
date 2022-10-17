#RocketLink - WEBSITE - CLOUD/ONLINE FILE SHARING

=-=-=-=-=-=-=-=-=-= Why? =-=-=-=-=-=-=-=-=-=

The initial idea of this project was to create a CLOUD service. By making a person upload files on the server, which is available online, it is possible to download,upload new files or share the url link.

Due to my knowledge, when starting the project, I found myself with a difficulty at uploading large files directly trough the browser (HTML). However after a few days of searching for information about this subject, I discovered a library, called "plupload" that made this project move forward. At the moment this project is capable to upload files without any limit, but I have set a limit of 250G's, as most CLOUDS do allow.

I thought it would be much easier to start by creating a kind of "WE TRANSFER", since the concept is very similar, the files are uploaded to the server by the user on the website, where they are stored, a link is issued and it is possible to download the files from that shared link. The files stay on the server only for 7 days and are deleted automatically if the file exceeds this time frame on the server.

=-=-=-=-=-=-=-=-=-= Tools Used=-=-=-=-=-=-=-=-=-=

Java Script

PHP

HTML and CSS (bootstrap)

XAMPP

Windows Task Scheduler

=-=-=-=-=-=-=-=-=-= Programming Logic =-=-=-=-=-=-=-=-=-=

For the server creation I used XAMPP.

____(To test how it works just download the "htdocs" folder and replace it with the old one which is inside the location of the files inside "XAMPP". Then just start "Apache" in XAMPP and open the web browser on "localhost".___

=-=-=-=-=-=-=-=-=-=   HOW DOES IT WORK: =-=-=-=-=-=-=-=-=-=

The large file to be uploaded is broken down into chunks, as soon as the chunks are on the server, a message is sent saying that the upload is complete.

Then a random user number is created, which will name the folder where these files will go (the randomly generated number is sent to the file "folderID.txt" to then return that value as the folder name). NOTE: It was done this way, for the simple reason that the plupload works by loops and if, when exporting the variable to another script document, it is always generated the command to also ask for the random number always different by the amount of chunks distributed.

Then the files are sent to a compressed ("zip") folder with the same name, and the original folder is deleted.

A link url is then generated, where it is possible to download the folder with all the files. The variable for the name of the folder is passed by the URL. (The name of the files in that folder, the size of each file and the total size of the folder are displayed).

All files older than 7 days on the server are deleted (Windows Task Scheduler)

Although everything is functional, I think that I should better organize the files next time.
