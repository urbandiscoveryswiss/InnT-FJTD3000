package ch.ffhs.innt.fjdt_3000.urbandiscovery.gui;

import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.ServiceConnection;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import android.os.Message;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.R;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.adapter.OfferListAdapter;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.OfferSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.UserSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.service.GeoPositionsService;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.service.GeoPositionsService.GeoPositionsServiceBinder;
import io.swagger.client.model.Offer;
import io.swagger.client.model.User;

public class MainActivity extends ToolbarActivity  {
    private static final String TAG = MainActivity.class.getSimpleName();

    private List<Offer> offerList;
    private List<User> userList;
    private OfferListAdapter offerListAdapter;

    private OfferSpeicher offerSpeicher;
    private UserSpeicher userSpeicher;

    private long offerID;

    private boolean serviceStarted = false;
    private GeoPositionsServiceBinder geoPositionService = null;


    private Handler mainCallbackHandler = new Handler(){
        public void handleMessage(Message msg){
            Bundle bundle = msg.getData();
            if (bundle != null) {
                Log.d(TAG, "CallbackHandler");
                updateList();
            }
            super.handleMessage(msg);
        }
    };

    private ServiceConnection geoPositionServiceConnection = new ServiceConnection() {
        private final String TAG = "geoPositionServiceCon";
        @Override
        public void onServiceConnected(ComponentName name, IBinder service) {
            Log.d(TAG, "onServiceConnected");
            geoPositionService = (GeoPositionsServiceBinder) service;
            geoPositionService.setActivityCallbackHandler(mainCallbackHandler);
        }

        @Override
        public void onServiceDisconnected(ComponentName name) {
            geoPositionService = null;
            Log.d(TAG, "onServiceDisconnected");
        }

    };


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Log.d(TAG, "onCreate");

        setContentView(R.layout.activity_main);
        setUpToolbar("");

        Intent geoPositionServiceIntent = new Intent(this, GeoPositionsService.class);

        // starte Service zum Ermitteln der eigenen Position:
        startService(geoPositionServiceIntent);
        bindService(geoPositionServiceIntent,geoPositionServiceConnection, Context.BIND_AUTO_CREATE);

        this.offerList = new ArrayList<Offer>();
        this.userList = new ArrayList<User>();

        this.offerSpeicher = new OfferSpeicher(this);
        this.userSpeicher = new UserSpeicher(this);



        this.offerListAdapter = new OfferListAdapter(this, this.offerList);
        ListView offerListView = (ListView) findViewById(R.id.offer_activity_list);
        offerListView.setAdapter(this.offerListAdapter);
        offerListView.setOnItemClickListener(new AdapterView.OnItemClickListener(){

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                String tagString = view.findViewById(R.id.offer_title).getTag().toString();
                if(!tagString.isEmpty()){
                    offerID = Long.valueOf(tagString).longValue();
                    Log.d(TAG, "Angebot ID ist: " + offerID);
                }

                Offer offer = offerSpeicher.loadOffer(offerSpeicher.findIDbyUID(offerID));

                String color = view.findViewById(R.id.offer_layout).getTag().toString();

                User user = userSpeicher.loadUser(userSpeicher.findIDbyUID(offer.getUserid()));

                final Intent i = new Intent(MainActivity.this, DetailsActivity.class);
                i.putExtra(DetailsActivity.IN_PARAM_COLOR, color);
                i.putExtra(DetailsActivity.IN_PARAM_OFFER_TITLE, offer.getTitle());
                i.putExtra(DetailsActivity.IN_PARAM_OFFER_DESCRIPTION, offer.getDescription());
                i.putExtra(DetailsActivity.IN_PARAM_OFFER_CONDITION, offer.getCondition());
                i.putExtra(DetailsActivity.IN_PARAM_USER_NAME, user.getFirstname()+" "+user.getName());
                i.putExtra(DetailsActivity.IN_PARAM_USER_ADDR, user.getAddress());
                i.putExtra(DetailsActivity.IN_PARAM_USER_CITY, user.getZip()+" "+user.getCity());
                i.putExtra(DetailsActivity.IN_PARAM_USER_COORDINATES, user.getCoordinates());

                Log.d(TAG, "Details anzeigen fuer WebsiteFeed " + offerID);
                startActivity(i);
            }
        });

        updateList();

    }



    public void updateList() {
        this.offerList = null;
        this.offerList = offerSpeicher.getOfferList();
        this.userList = userSpeicher.getUserList();
        this.offerListAdapter.updateList(offerList);

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.settings, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.menu_settings:
                startActivity(new Intent(this,
                        Settings.class));
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

}
