<?
//Class to handle the database connections
Class DatabaseConnection{

    protected $databaseName="cartDb";
    protected $hostName="localhost";
    protected $username="root";
    protected $password="";

    //This function returns the mysql connection object.
    public function getConnection()
    {
        ////To check whether database connection is done or not
        if(!mysqli_connect($this->hostName,$this->username,$this->password,$this->databaseName))
        {
            die("Connection Failed: ".mysqli_connect_error());
        }
        return mysqli_connect($this->hostName,$this->username,$this->password,$this->databaseName);
    }
}
?>