This parking system app is developed using PHP (Object Oriented Programming). The overview of the app can be found below.

Github link :
    https://github.com/sloki009/parking.git

FILES:

    1. File.php         ## Handles file operations Ex: reading input file holding commands
    2. Parking.php      ## Contains methods to handle commands that are provided
    3. main.php         ## This is te main file need to run in command line
    4. input.txt        ## Contains all commands for parking system

Steps to run the file:

    1. install PHP

        On MAC :
            brew tap
            brew tap homebrew/core
            brew install php@8.0

        On Ubuntu :
            sudo su
            add-apt-repository ppa:ondrej/php -y
            apt-get update
            apt-get install php8.0 php8.0-dev php8.0-xml -y --allow-unauthenticated

    2. Clone the project from github link, https://github.com/sloki009/parking.git
    
    3. Open the CMD.

    4. Type the command in CMD as follows:

            \path\to\php main.php filename fileDir

            Example: if php is installed at /usr/bin/php7.0 and filename is "input.txt" then the command should be /usr/bin/php7.0 main.php input.txt (considering input.txt and main.php are in same folder).

    5. If arguments is missing or in case of wrong input filename, you will get an error message from main.php in CMD.

    6. If everything goes right, you will find the results in CMD.