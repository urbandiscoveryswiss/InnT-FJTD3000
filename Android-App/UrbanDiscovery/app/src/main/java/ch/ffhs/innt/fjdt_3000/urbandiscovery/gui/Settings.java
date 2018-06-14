/**
 * 
 */
package ch.ffhs.innt.fjdt_3000.urbandiscovery.gui;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.preference.PreferenceActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.R;


public class Settings extends PreferenceActivity {

  public static final String SETTINGS_NAME = Settings.class.getSimpleName();

  private static final int SETTINGS_EDIT_ID = Menu.FIRST;

  @Override
  @SuppressLint("NewApi")
  protected void onCreate(Bundle icicle) {
    super.onCreate(icicle);

    this.addPreferencesFromResource(R.xml.settings);
  }
  
  @Override
  public boolean onCreateOptionsMenu(Menu menu) {
    menu.add(0, SETTINGS_EDIT_ID, Menu.NONE,
        R.string.settings);

    return super.onCreateOptionsMenu(menu);
  }

  @Override
  public boolean onOptionsItemSelected(MenuItem item) {
    switch (item.getItemId()) {
      default:
        Log.w(SETTINGS_NAME,
            "unbekannte Option gewaehlt: " + item);
        return super.onOptionsItemSelected(item);
    }
  }
}
