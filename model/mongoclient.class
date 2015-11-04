MongoClient {
/* Constantes */
const string VERSION ;
const string DEFAULT_HOST = "localhost" ;
const int DEFAULT_PORT = 27017 ;
const string RP_PRIMARY = "primary" ;
const string RP_PRIMARY_PREFERRED = "primaryPreferred" ;
const string RP_SECONDARY = "secondary" ;
const string RP_SECONDARY_PREFERRED = "secondaryPreferred" ;
const string RP_NEAREST = "nearest" ;
/* Propiedades */
public boolean $connected = FALSE ;
public string $status = NULL ;
protected string $server = NULL ;
protected boolean $persistent = NULL ;
/* Métodos */
public __construct ([ string $server = "mongodb://localhost:27017" [, array $options = array("connect" => TRUE) [, array $driver_options ]]] )
public bool close ([ boolean|string $connection ] )
public bool connect ( void )
public array dropDB ( mixed $db )
public MongoDB __get ( string $dbname )
public static array getConnections ( void )
public array getHosts ( void )
public array getReadPreference ( void )
public array getWriteConcern ( void )
public bool killCursor ( string $server_hash , int|MongoInt64 $id )
public array listDBs ( void )
public MongoCollection selectCollection ( string $db , string $collection )
public MongoDB selectDB ( string $name )
public bool setReadPreference ( string $read_preference [, array $tags ] )
public bool setWriteConcern ( mixed $w [, int $wtimeout ] )
public string __toString ( void )
}