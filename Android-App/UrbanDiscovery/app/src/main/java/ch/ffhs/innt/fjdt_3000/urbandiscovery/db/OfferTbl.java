/**
 * 
 */
package ch.ffhs.innt.fjdt_3000.urbandiscovery.db;

/**
 * Schnittstelle zur Tabelle GEOKONTAKTE. <br>
 * Die Klasse liefert
 * <ul>
 * <li>SQL-Code zur Erzeugung der Tabelle
 * <li>SQL-Code für alle für Amando erforderlichen
 * Statements
 * </ul>
 * 
 * @author pant
 */
public final class OfferTbl implements OfferColumns {

  public static final String TABLE_NAME = "offer";

  public static final String SQL_CREATE =
      "CREATE TABLE offer (" +
      "_id   INTEGER PRIMARY KEY AUTOINCREMENT," +
      "uid   INTEGER," +
      "userid INTEGER," +
      "title TEXT," +
      "description TEXT," +
      "condition TEXT," +
      "start TEXT, " +
      "end TEXT, " +
      "zeitstempel INTEGER " +
      ");";

  public static final String DEFAULT_SORT_ORDER =
    ZEITSTEMPEL + 
    " DESC";


  public static final String SQL_DROP =
      "DROP TABLE IF EXISTS " +
      TABLE_NAME;


  public static final String STMT_OFFER_INSERT =
      "INSERT INTO offer " +
      "(uid, userid, title, description, condition, start, end) " +
      "VALUES (?,?,?,?,?,?,?)";


  public static final String STMT_KONTAKT_DELETE =
    "DELETE offer ";
  

  public static final String STMT_KONTAKT_DELETE_BY_ID =
    "DELETE offer " +
    "WHERE _id = ?";

  public static final String[] ALL_COLUMNS = new String[] {
      ID,
      UID,
      USERID,
      TITLE,
      DESCRIPTION,
      CONDITION,
      START,
      END,
      ZEITSTEMPEL
      };


  public static final String WHERE_ID_EQUALS = ID + "=?";

  public static final String WHERE_UID_EQUALS = UID + "=?";


  public static final String STMT_COUNT_OFFER = "SELECT COUNT(*) FROM " + TABLE_NAME;
  public static final String STMT_DELETE_ALL_OFFER = "DELETE FROM " + TABLE_NAME;

  private OfferTbl() {
  }
}
