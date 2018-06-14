/**
 * 
 */
package ch.ffhs.innt.fjdt_3000.urbandiscovery.db;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.database.sqlite.SQLiteStatement;
import android.util.Log;



public class UDDatabase extends SQLiteOpenHelper {

  private static final String TAG = "UDDatabase";


  private static final String DATENBANK_NAME = "urbanDiscovery.db";


  private static final int DATENBANK_VERSION = 6;

  private static UDDatabase sINSTANCE;

  private static Object sLOCK = "";

  public static UDDatabase getInstance(Context context) {
    if( sINSTANCE == null ) {
      synchronized(sLOCK) {
        if( sINSTANCE == null ) {
          sINSTANCE = new UDDatabase(context.getApplicationContext());
        }
      }
    }
    return sINSTANCE;
  }

  private UDDatabase(Context context) {
    super(context, DATENBANK_NAME, null, 
        DATENBANK_VERSION);    
  }

  @Override
  public void onCreate(SQLiteDatabase db) {
    db.execSQL(UserTbl.SQL_CREATE);
    db.execSQL(OfferTbl.SQL_CREATE);
  }

  @Override
  public void onUpgrade(SQLiteDatabase db, int oldVersion,
                        int newVersion) {
    Log.w(TAG, "Upgrading database from version "
        + oldVersion + " to " + newVersion
        + ", which will destroy all old data");
    db.execSQL(UserTbl.SQL_DROP);
    db.execSQL(OfferTbl.SQL_DROP);
    onCreate(db);
  }

  
}
