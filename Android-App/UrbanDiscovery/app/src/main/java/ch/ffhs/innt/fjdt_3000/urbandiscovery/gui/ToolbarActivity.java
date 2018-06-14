package ch.ffhs.innt.fjdt_3000.urbandiscovery.gui;

import android.content.Intent;
import android.graphics.Typeface;
import android.net.Uri;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.R;

/**
 * Created by nbuser3 on 28.09.17.
 */

public abstract class ToolbarActivity extends AppCompatActivity {

    Toolbar mToolbar;

    protected void setUpToolbar(String TITLE) {
        mToolbar = (Toolbar) findViewById(R.id.my_toolbar);
        setSupportActionBar(mToolbar);
        //getSupportActionBar().setTitle(TITLE);
    }

}
