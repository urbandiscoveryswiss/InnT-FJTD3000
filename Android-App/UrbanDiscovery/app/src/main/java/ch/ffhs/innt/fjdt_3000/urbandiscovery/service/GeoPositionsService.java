package ch.ffhs.innt.fjdt_3000.urbandiscovery.service;

import android.Manifest;
import android.app.Service;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.Binder;
import android.os.Bundle;
import android.os.Handler;
import android.os.IBinder;
import android.os.Process;
import android.support.v4.app.ActivityCompat;
import android.util.Log;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.LocationListener;

import java.util.List;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.common.GpsData;


public class GeoPositionsService extends Service
        implements LocationListener, GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener {

    /** Tag für die LogCat. */
    private static final String TAG =
            GeoPositionsService.class.getSimpleName();

    private static final int MIN_ZEIT = 5000; // 5 Sekunden

    private static final int MIN_DISTANZ = 10; // 10 Meter

    private static final boolean USE_LOCATION_API_V2 = true;

    private static final long UPDATE_INTERVAL = 15000; // 5 Sekunden

    private static final long SCHNELLSTES_INTERVAL = 5000; // 1 Sekunde

    private GpsData mGpsData;

    private static boolean mPositionNachverfolgen;

    /** Binder für Zugriff auf diesen Service. */
    private final IBinder mGpsBinder =
            new GeoPositionsServiceBinder();

    private Handler mainCallbackHandler;

    private GoogleApiClient mGoogleApiClient;

    private LocationRequest mLocationRequest;


    public class GeoPositionsServiceBinder extends Binder {

        public void setActivityCallbackHandler(
                final Handler callback) {
            mainCallbackHandler = callback;
        }

    }

    @Override
    public void onCreate() {
        Log.d(TAG, "onCreate(): PID: " + Process.myPid());
        Log.d(TAG, "onCreate(): TID: " + Process.myTid());
        Log.d(TAG, "onCreate(): UID: " + Process.myUid());

        if (USE_LOCATION_API_V2) {
            boolean usePlayService = isGooglePlayServiceAvailable();
            if (usePlayService) {
                Log.i(TAG, "onCreate(): verwende die neue Location API mit dem Fuse-Provider");
                starteGeoProvider();
            }
        } else {
            starteGeoProvider();
        }

        if (mGoogleApiClient != null) {
            mGoogleApiClient.connect();
        }

        mPositionNachverfolgen = true;
    }

    @Override
    public void onDestroy() {
        if (mGoogleApiClient != null) {
            mGoogleApiClient.disconnect();
        }
        super.onDestroy();
    }

    @Override
    public IBinder onBind(final Intent intent) {
        Log.d(TAG, "onBind(): entered...");
        return mGpsBinder;
    }

    @Override
    public boolean onUnbind(Intent intent) {
        Log.d(TAG, "onUnbind(): entered...");
        mainCallbackHandler = null;
        return super.onUnbind(intent);
    }

    private void starteGeoProvider() {
        Log.d(TAG, "starteGeoProvider(): entered...");
        if (USE_LOCATION_API_V2) {
            mGoogleApiClient = new GoogleApiClient.Builder(this)
                    .addApi(LocationServices.API)
                    .addConnectionCallbacks(this)
                    .addOnConnectionFailedListener(this)
                    .build();
            Log.d(TAG, "setInterval");
            mLocationRequest = LocationRequest.create();
            mLocationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
            mLocationRequest.setInterval(UPDATE_INTERVAL);
            // Set the fastest update interval to 1 second
            mLocationRequest.setFastestInterval(SCHNELLSTES_INTERVAL);
        }
    }


    private void sendeGeoPositionImpl(final boolean sofort) {
        Log.d(TAG, "sendeGeoPositionImpl(): sofort = " + sofort);
        Log.d(TAG, "sendeGeoPositionImpl(): mPositionNachverfolgen = "+ mPositionNachverfolgen);

        final long vorDreiMinuten = System.currentTimeMillis() - 180000L;
        if (sofort || mGpsData.getZeitstempel() < vorDreiMinuten) {
            Log.d(TAG,"_sendeGeoPosition(): ");

            if (mPositionNachverfolgen) {
                sendeGeoPositionAnServer();
            }
        } else {
            Log.w(TAG, "sendeGeoPositionImpl(): sofort: " + sofort);
            Log.w(TAG, "sendeGeoPositionImpl(): mGpsData: " + mGpsData.toString());
        }
    }

    private void sendeGeoPositionAnServer() {
        Log.d(TAG,"sendeGeoPositionAnServer()");

        new RetriveOffersTask(this, mGpsData, mainCallbackHandler).execute();

    }

    @Override
    public void onLocationChanged(Location location) {
        Log.d(TAG, "MyLocationListener->onLocationChanged(): entered...");
        if (location != null) {
            Log.d(TAG,"MyLocationListener->onLocationChanged(): " + "Längengrad: " + location.getLongitude());
            Log.d(TAG,"MyLocationListener->onLocationChanged(): " + "Breitengrad: " + location.getLatitude());

            mGpsData = new GpsData(location);

            if (mPositionNachverfolgen) {
                sendeGeoPositionImpl(true);
            }

        }
    }



    @Override
    public void onConnectionFailed(ConnectionResult arg0) {
        // TODO Auto-generated method stub

    }

    @Override
    public void onConnected(Bundle arg0) {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }
        Location location = LocationServices.FusedLocationApi.getLastLocation(mGoogleApiClient);
    mGpsData = new GpsData(location);

    LocationServices.FusedLocationApi.requestLocationUpdates(mGoogleApiClient, mLocationRequest, (com.google.android.gms.location.LocationListener) this);

  }

  @Override
  public void onConnectionSuspended(int i) {

  }

  
  private boolean isGooglePlayServiceAvailable() {
    int errorCode = GooglePlayServicesUtil
            .isGooglePlayServicesAvailable(this);
    if (errorCode != ConnectionResult.SUCCESS) {
        return false;
    }
    return true;
  }

}
