package ch.ffhs.innt.fjdt_3000.urbandiscovery.gui;

import android.Manifest;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.content.Intent;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import java.util.ArrayList;
import java.util.List;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.R;
import io.swagger.client.model.Offer;
import io.swagger.client.model.User;

public class DetailsActivity extends ToolbarActivity implements OnMapReadyCallback {
    private static final String TAG = DetailsActivity.class.getSimpleName();
    public static final String IN_PARAM_OFFER_TITLE = "IN_PARAM_OFFER_TITLE";
    public static final String IN_PARAM_COLOR = "IN_PARAM_COLOR";
    public static final String IN_PARAM_OFFER_DESCRIPTION = "IN_PARAM_OFFER_DESCRIPTION";
    public static final String IN_PARAM_OFFER_CONDITION = "IN_PARAM_OFFER_CONDITION";
    public static final String IN_PARAM_USER_NAME = "IN_PARAM_USER_NAME";
    public static final String IN_PARAM_USER_ADDR = "IN_PARAM_USER_ADDR";
    public static final String IN_PARAM_USER_CITY = "IN_PARAM_USER_CITY";
    public static final String IN_PARAM_USER_COORDINATES = "IN_PARAM_USER_COORDINATES";

    private String color;
    private String offerTitle;
    private String offerDescription;
    private String offerCondition;
    private String userName;
    private String userAddr;
    private String userCity;
    private String userCoordinates;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details);
        setUpToolbar("");
        Log.d(TAG, "onCreate");

        final Bundle extras = getIntent().getExtras();
        if (extras != null && extras.containsKey(IN_PARAM_OFFER_TITLE)) {
            this.color = extras.getString(IN_PARAM_COLOR);
            this.offerTitle = extras.getString(IN_PARAM_OFFER_TITLE);
            this.offerDescription = extras.getString(IN_PARAM_OFFER_DESCRIPTION);
            this.offerCondition = extras.getString(IN_PARAM_OFFER_CONDITION);
            this.userName = extras.getString(IN_PARAM_USER_NAME);
            this.userAddr = extras.getString(IN_PARAM_USER_ADDR);
            this.userCity = extras.getString(IN_PARAM_USER_CITY);
            this.userCoordinates = extras.getString(IN_PARAM_USER_COORDINATES);
        }

        LinearLayout offer_details_layout = (LinearLayout) findViewById(R.id.offer_details_layout);

        offer_details_layout.setBackgroundColor(Color.parseColor(color));

        TextView offer_details_title = (TextView) findViewById(R.id.offer_details_title);
        offer_details_title.setText(offerTitle);

        TextView offer_details_description = (TextView) findViewById(R.id.offer_details_description);
        offer_details_description.setText(offerDescription);

        TextView offer_details_condition = (TextView) findViewById(R.id.offer_details_condition);
        offer_details_condition.setText(offerCondition);

        TextView offer_details_user_name = (TextView) findViewById(R.id.offer_details_user_name);
        offer_details_user_name.setText(userName);

        TextView offer_details_user_address = (TextView) findViewById(R.id.offer_details_user_address);
        offer_details_user_address.setText(userAddr);

        TextView offer_details_user_city = (TextView) findViewById(R.id.offer_details_user_city);
        offer_details_user_city.setText(userCity);

        MapFragment mapFragment = (MapFragment) getFragmentManager()
                .findFragmentById(R.id.offer_details_map);
        mapFragment.getMapAsync(this);

    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        Double Lat = Double.parseDouble(userCoordinates.split(",")[0]);
        Double Lng = Double.parseDouble(userCoordinates.split(",")[1]);


        LatLng sydney = new LatLng(Lat,Lng);

        Log.d(TAG, "LatLng" + sydney.toString());

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {

            return;
        }
        googleMap.setMyLocationEnabled(true);
        googleMap.moveCamera(CameraUpdateFactory.newLatLngZoom(sydney, 13));

        googleMap.addMarker(new MarkerOptions()
                .title("Sydney")
                .snippet("The most populous city in Australia.")
                .position(sydney));
    }
}
