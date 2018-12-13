<?php

class DynLoad
{
    private static $sqlConnectionLink;

//########################################################################################

    public function init()
    {
        require("dynload.lib.config.php");
        self::$sqlConnectionLink = mysqli_connect($dynloadConfigDatabaseHost,$dynloadConfigDatabaseUser,$dynloadConfigDatabasePass,$dynloadConfigDatabaseName) OR die("<br><br><b>Error in dynload.lib.php :</b> Could not connect to Database (Code 1)<br><br>");
    }

//########################################################################################

    public static function Link()
    {
        echo '
            <script src="dynload.lib/source/dynload.lib.js"></script>
            <iframe hidden src="dynload.lib/source/dynloadFrame.php" id="dynloadFrame"></iframe>
        ';
    }

    public static function Scalar($sqlStatement)
    {
        $stmt = self::$sqlConnectionLink->prepare($sqlStatement);
        $stmt->execute();
        $result = $stmt->get_result();
        $value = $result->fetch_array();
        $stmt->close();

        return $value[0];
    }

    public static function Count($sqlStatement)
    {
        $stmt = self::$sqlConnectionLink->prepare($sqlStatement);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();

        return $count;
    }

    public static function Cluster($sqlStatement)
    {
        $rowArray = array();
        $stmt = self::$sqlConnectionLink->prepare($sqlStatement);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) array_push($rowArray,$row);
        $stmt->close();

        return $rowArray;
    }

    public static function Exist($sqlStatement,$parameterTypes="", &...$sqlParameters)
    {
        $stmt = self::$sqlConnectionLink->prepare($sqlStatement);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();

        return $count!=0;
    }
    
}
DynLoad::init()

?>