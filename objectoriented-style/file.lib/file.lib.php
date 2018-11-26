<?php

class File
{
##########################################################################################

    private static $sqlConnectionLink;

    private $fileFormElementName;
    private $fileUploadDirectory;
    private $fileCustomName;
    private $fileSQLEntry;
    private $fileValidFormats = array();
    private $fileMaxSize;


##########################################################################################

    public function __construct()
    {
        require("file.lib.config.php");

        $this->fileUploadDirectory = $fileConfigDefaultUploadDirectory;
        $this->fileCustomName = "";
        $this->fileSQLEntry = "";
        $this->fileMaxSize = 99999999;

    }

    public static function init()
    {
        require("file.lib.config.php");

        self::$sqlConnectionLink = mysqli_connect($sqlConfigDatabaseHost,$sqlConfigDatabaseUser,$sqlConfigDatabasePass,$sqlConfigDatabaseName) OR die("<br><br><b>Error in file.lib.php :</b> Could not connect to Database (Code 1)<br><br>");
    }

    public function Close()
    {
        $this->$sqlConnectionLink->close();
    }

##########################################################################################

    private function SaveReplace($string)
    {
        // DESCRIPTION:
        // Formats a given string so it is save for URL-names etc.
        // $string  The string that should be formated

        // Replacing "Ä,ä,Ö,ö,Ü,ü,ß" and "-" (HTML-Characters)
        $sstr = str_replace(' ','-',$string);
        $sstr = str_replace('&Auml;','AE',$sstr);
        $sstr = str_replace('&auml;','ae',$sstr);
        $sstr = str_replace('&Ouml;','OE',$sstr);
        $sstr = str_replace('&ouml;','oe',$sstr);
        $sstr = str_replace('&Uuml;','UE',$sstr);
        $sstr = str_replace('&uuml;','ue',$sstr);
        $sstr = str_replace('&szlig;','ss',$sstr);

        // Replacing "Ä,ä,Ö,ö,Ü,ü,ß" (UTF-Characters/Database)
        $sstr = str_replace('Ã„','AE',$sstr);
        $sstr = str_replace('Ã¤','ae',$sstr);
        $sstr = str_replace('Ã–','OE',$sstr);
        $sstr = str_replace('Ã¶','oe',$sstr);
        $sstr = str_replace('Ãœ','UE',$sstr);
        $sstr = str_replace('Ã¼','ue',$sstr);
        $sstr = str_replace('ÃŸ','ss',$sstr);

        // Remove everything but Alphanumeric letters and allowed characters
        $sstr = preg_replace('/[^0-9A-Za-z-_+.\|]/', '', $sstr);

        return $sstr;
    }

    private static function MySQLNonQuery($sqlStatement)
    {
        $stmt = self::$sqlConnectionLink->prepare($sqlStatement);
        $stmt->execute();
        $stmt->close();
    }

##########################################################################################

    public function SetFile($phpFormElementName)
    {
        $this->fileFormElementName = $phpFormElementName;
    }

    public function SetPath($uploadPathDirectory)
    {
        $this->fileUploadDirectory = $uploadPathDirectory;
    }

    public function SetName($customFileName)
    {
        $this->fileCustomName = $customFileName;
    }

    public function SetSQLEntry($sqlStatement)
    {
        $this->fileSQLEntry = $sqlStatement;
    }

    public function SetFileTypes(...$fileTypeExtensions)
    {
        $this->fileValidFormats = ...$fileTypeExtensions;
    }

    public function SetMaxFileSize($maximumFileSize)
    {
        $this->fileMaxSize = $maximumFileSize;
    }

##########################################################################################

    public function Upload()
    {
        // Create directory if not existing
        if(!is_dir($path)) mkdir($path, 0750);

        // Upload Files to Server
        $count=0;

        foreach ($this->SaveReplace($_FILES[$this->fileFormElementName]['name']) AS $file => $name)
        {
            // Skip if no file is selected
            if ($_FILES[$this->fileFormElementName]['error'][$file] == 4) continue;

            // Continue if no errors occure
            if ($_FILES[$this->fileFormElementName]['error'][$file] == 0)
            {
                // Error: File to big
                if ($_FILES[$this->fileFormElementName]['size'][$file] > $this->fileMaxSize)
                {
                    $message[] = "$name is too large!.";
                    continue;
                }

                // Error: Forbidden filetype
                else if(!empty($this->fileValidFormats) AND !in_array(pathinfo($name, PATHINFO_EXTENSION), $this->fileValidFormats))
                {
                    $message[] = "$name is not a valid format";
                    continue;
                }

                // Upload if all checkpoints have been passed
                else
                {
                    if(move_uploaded_file($_FILES[$this->fileFormElementName]["tmp_name"][$file], $this->fileUploadDirectory.$name))
                    {

                        if($this->fileCustomName != "")
                        {
                            // Get filetype extension
                            $extension = pathinfo($this->fileUploadDirectory.$name, PATHINFO_EXTENSION);

                            // rename the uploaded file
                            rename($this->fileUploadDirectory.$name, $this->fileUploadDirectory.$this->fileCustomName.'.'.$extension);
                            $name = $this->fileCustomName.'.'.$extension;
                        }
                        $count++;
                    }
                    if($this->fileSQLEntry != "")
                    {
                        $fileSQLStatement = $this->fileSQLEntry

                        $fileSQLStatement = str_replace("@FILENAME",$name,$fileSQLStatement);
                        $fileSQLStatement = str_replace("@FILEEXTENSION",pathinfo($this->fileUploadDirectory.$name, PATHINFO_EXTENSION),$fileSQLStatement);

                        self::MySQLNonQuery($fileSQLStatement);
                    }
                }
            }
        }

        $this->Close();
    }
}
File::init();

?>