/**
 * 
 */
package ch.ffhs.innt.fjdt_3000.urbandiscovery.db;


public final class UserTbl implements UserColumns {

  public static final String TABLE_NAME = "user";

  /**
   * SQL Anweisung zur Schemadefinition.
   */
  public static final String SQL_CREATE =
      "CREATE TABLE user (" +
      "_id   INTEGER PRIMARY KEY AUTOINCREMENT," +
      "uid INTEGER NOT NULL," +
      "username TEXT NOT NULL," +
      "firstname TEXT NOT NULL," +
      "name TEXT NOT NULL," +
      "address TEXT," +
      "zip TEXT," +
      "city TEXT," +
      "coordinates TEXT," +
      "email TEXT," +
      "zeitstempel INTEGER " +
      ");";
  

  public static final String DEFAULT_SORT_ORDER =
    ZEITSTEMPEL + 
    " DESC";


  public static final String SQL_DROP =
      "DROP TABLE IF EXISTS " +
      TABLE_NAME;


  public static final String STMT_USER_INSERT =
      "INSERT INTO user " +
      "(uid,username,fistname,name,address,city,coordinates,email) " +
      "VALUES (?,?,?,?,?,?,?,?)";


  public static final String STMT_KONTAKT_DELETE =
    "DELETE user ";
  

  public static final String STMT_KONTAKT_DELETE_BY_ID =
    "DELETE user " +
    "WHERE _id = ?";


  public static final String[] ALL_COLUMNS = new String[] {
      ID,
      UID,
      USERNAME,
      FIRSTNAME,
      NAME,
      ADDRESS,
      ZIP,
      CITY,
      COORDINATES,
      EMAIL,
      ZEITSTEMPEL
      };


  public static final String WHERE_ID_EQUALS = ID + "=?";

  public static final String WHERE_UID_EQUALS = UID + "=?";

  public static final String STMT_COUNT_USER = "SELECT COUNT(*) FROM " + TABLE_NAME;

  private UserTbl() {
  }
}
