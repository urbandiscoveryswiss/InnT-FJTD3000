package ch.ffhs.innt.fjdt_3000.urbandiscovery.service;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.preference.PreferenceManager;
import android.util.Log;
import android.util.Xml;

import java.util.List;
import java.util.concurrent.ExecutionException;
import java.util.concurrent.TimeoutException;

import ch.ffhs.innt.fjdt_3000.urbandiscovery.common.GpsData;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.OfferSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.db.UserSpeicher;
import ch.ffhs.innt.fjdt_3000.urbandiscovery.gui.MainActivity;
import io.swagger.client.api.OfferApi;
import io.swagger.client.model.Offer;
import io.swagger.client.model.User;

public class RetriveOffersTask extends AsyncTask<String, Void, List<Offer>> {
    private static final String TAG = RetriveOffersTask.class.getSimpleName();

    private Context context;
    private GpsData gpsData;
    private Handler mainCallbackHandler;

    private OfferSpeicher offerSpeicher;
    private UserSpeicher userSpeicher;

    public RetriveOffersTask(Context context, GpsData gpsData, Handler mainCallbackHandler){
        this.context = context;
        this.gpsData = gpsData;
        this.mainCallbackHandler = mainCallbackHandler;
        this.offerSpeicher = new OfferSpeicher(context);
        this.userSpeicher = new UserSpeicher(context);
    }


    @Override
    protected List<Offer> doInBackground(String... strings) {
        Log.d(TAG, "Start Retrieving");
        OfferApi apiInstance = new OfferApi();
        List<Offer> offerList = null;

        SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(context);
        String radius = prefs.getString("distance", "1000");

        Log.d(TAG, "Radius = "+Long.valueOf(radius));

        try {
            offerList = apiInstance.findOffersByCoordinates(gpsData.getBreitengrad()+","+gpsData.getLaengengrad(), Long.valueOf(radius));
            if(offerList != null){
                Log.d(TAG, offerList.toString());
            }

        } catch (InterruptedException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (ExecutionException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (io.swagger.client.ApiException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        } catch (TimeoutException e) {
            System.err.println("Exception when calling OfferApi#addOffer");
            e.printStackTrace();
        }

        return offerList;
    }



    protected void onPostExecute(List<Offer> offerList) {
        SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(context);
        boolean keep = prefs.getBoolean("keep", false);
        Log.d(TAG, "Keep = "+keep);


        if(offerList != null) {
            boolean newOffers = false;
            for (Offer offer : offerList) {
                if (offerSpeicher.findIDbyUID(offer.getId()) == 0) {
                    newOffers = true;
                }
            }
            if (newOffers == false && offerList.size() == offerSpeicher.getRowCount()){
                //alles gleich
            }else{
                if(keep == false) {
                    offerSpeicher.deleteAllOffers();
                }
                for (Offer offer : offerList) {
                    if(offerSpeicher.findIDbyUID(offer.getId())==0){
                        newOffers = true;
                    }
                    offerSpeicher.saveOrUpdateOffer(offer);
                    long offerUserID = offer.getUserid();
                    //if(userSpeicher.findIDbyUID(offerUserID) == 0){
                        new RetrieveUserTask(context, offerUserID).execute();
                    //}
                }
                if(mainCallbackHandler != null){
                    Message msg = new Message();
                    Bundle bundle = new Bundle();

                    mainCallbackHandler.sendMessage(msg);
                }
            }
        }else{
            if(offerSpeicher.getRowCount()>0 && keep == false){
                offerSpeicher.deleteAllOffers();
                if(mainCallbackHandler != null){
                    Message msg = new Message();
                    Bundle bundle = new Bundle();

                    mainCallbackHandler.sendMessage(msg);
                }
            }
        }


        super.onPostExecute(offerList);
    }
}
